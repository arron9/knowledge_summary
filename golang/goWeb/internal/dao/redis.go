package dao

import (
	"github.com/gomodule/redigo/redis"
	"time"
)

func newRedis() redis.Conn {
	conn, err := redis.Dial("tcp", "172.16.32.243:6480", redis.DialConnectTimeout(time.Second*6))
	if err != nil {
		panic(err)
	}

	return conn
}
