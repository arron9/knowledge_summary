package main

import (
	"chenChat/internal/conf"
	"chenChat/internal/server/controller"
	"chenChat/internal/service"
	"chenChat/pkg/utils"
	"fmt"
	_ "github.com/go-sql-driver/mysql"
	"os"
	"os/signal"
	"syscall"
)

func main() {
	svc := service.New()
	httpsrv := controller.New(svc)

	httpConfig := &conf.Http{}
	utils.LoadConfig("http.yml", httpConfig)

	httpsrv.Run(httpConfig.Server.Addr)
	c := make(chan os.Signal, 1)
	signal.Notify(c, syscall.SIGKILL, syscall.SIGQUIT)
	for {
		s := <-c
		switch s {
		case syscall.SIGKILL, syscall.SIGQUIT:
			fmt.Printf("pragram exit")
		default:
			fmt.Printf("other signal")
		}
	}
}
