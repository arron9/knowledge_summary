package service

import "chenChat/internal/model"

func (svc *Service) GetBanners(bannerOpt model.BannerOption) (banners []*model.Banner, err error) {
	banners, err = svc.dao.ListBanners(bannerOpt)
	if err != nil {
		panic(err)
	}

	return
}
