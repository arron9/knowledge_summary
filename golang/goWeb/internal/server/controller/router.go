package controller

import "github.com/gin-gonic/gin"

func initRoute(r *gin.Engine)  {
	r.GET("/banner", banners)
}
