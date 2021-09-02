package dao

import (
	"database/sql"
	"github.com/gomodule/redigo/redis"
)

type Dao interface {
	BannerDao
}

type dao struct {
	db    *sql.DB
	redis redis.Conn
}

func New() Dao {
	return &dao{
		db:    newMysql(),
		redis: newRedis(),
	}
}
