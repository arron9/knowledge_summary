package controller

import (
	"chenChat/internal/model"
	"github.com/gin-gonic/gin"
)

func banners(ctx *gin.Context) {
	bannerOpt := model.BannerOption{}
	_ = ctx.ShouldBindQuery(&bannerOpt)
	banner, err := svc.GetBanners(bannerOpt)
	if err != nil {
		panic(err)
	}

	ctx.JSON(200, banner)
}
