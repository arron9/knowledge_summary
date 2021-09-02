package controller

import (
	"chenChat/internal/service"
	"github.com/gin-gonic/gin"
)

var svc *service.Service


func New(s *service.Service) *gin.Engine {
	svc = s
	r := gin.Default()
	initRoute(r)

	return r
}