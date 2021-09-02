package service

import "chenChat/internal/dao"

type Service struct {
	dao dao.Dao
}

func New() *Service {
	return &Service{
		dao:dao.New(),
	}
}
