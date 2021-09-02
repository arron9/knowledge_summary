package dao

import (
	"chenChat/internal/conf"
	"chenChat/internal/model"
	"chenChat/pkg/utils"
	"database/sql"
	"github.com/didi/gendry/builder"
	"github.com/didi/gendry/scanner"
	"github.com/imdario/mergo"

	_ "github.com/go-sql-driver/mysql"
)

const (
	maxLimit = 10000000
)

func newMysql() *sql.DB {
	mysqlConfig := &conf.Mysql{}
	utils.LoadConfig("mysql.yml", mysqlConfig)
	db, err := sql.Open("mysql", mysqlConfig.MysqlConfig.Dsn)
	if err != nil {
		panic(err)
	}

	return db
}

func (d *dao) query(tbl string, where map[string]interface{}, selects []string, pageConfig *model.Pagination, ret interface{}) error {
	pageWhere := d.BuildPage(pageConfig)
	_ = mergo.Map(where, pageWhere)
	conds, vals, err := builder.BuildSelect(tbl, where, selects)
	if err != nil {
		panic(err)
	}

	rows, err := d.db.Query(conds, vals...)
	if err != nil {
		return err
	}

	defer rows.Close()
	scanner.Scan(rows, ret)

	return nil
}

func (d *dao) BuildPage(pageOpt *model.Pagination) map[string]interface{} {
	var (
		skip, limit uint
	)
	where := map[string]interface{}{}
	if pageOpt == nil || pageOpt.Page == 0 || pageOpt.PageSize == 0 {
		return where
	}

	if pageOpt.NoPage == 1 {
		where["_limit"] = []int{maxLimit}
		return where
	}

	skip = uint((pageOpt.Page - 1) * pageOpt.PageSize)
	limit = uint(pageOpt.PageSize)
	where = map[string]interface{}{
		"_limit": []uint{skip, limit},
	}

	return where
}
