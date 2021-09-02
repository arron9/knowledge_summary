package conf

type Http struct {
	Server Server `yaml:"server"`
}

type Server struct {
	Addr    string `yaml:"addr"`
	Timeout string `yaml:"timeout"`
}

type Mysql struct {
	MysqlConfig MysqlConfig `yaml:"mysqlconfig"`
}

type MysqlConfig struct {
	Dsn string `yaml:"dsn"`
}
