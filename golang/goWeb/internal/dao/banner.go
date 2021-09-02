package dao

import (
	"chenChat/internal/model"
)

type BannerDao interface {
	ListBanners(bannerOpt model.BannerOption) ([]*model.Banner, error)
}

func (d *dao) ListBanners(bannerOpt model.BannerOption) (banners []*model.Banner, err error) {
	banner := new(model.Banner)
	where := map[string]interface{}{
		"id": bannerOpt.Id,
	}

	pageOpt := &model.Pagination{}
	pageOpt.NoPage = 0
	pageOpt.Page = 1
	pageOpt.PageSize = 100
	err = d.query(model.TableBanner, where, banner.Fields(), pageOpt, &banners)
	if err != nil {
		return
	}

	return banners, nil
}
