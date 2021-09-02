package model

import "time"

const (
	TableBanner = "banner"
)

// Banner ...
type Banner struct {
	ID        int       `json:"id,omitempty" ddb:"id"`
	Ctime     time.Time `json:"ctime,omitempty" ddb:"ctime"`
	Mtime     time.Time `json:"mtime,omitempty" ddb:"mtime"`
	IsDeleted bool      `json:"is_deleted,omitempty" ddb:"is_deleted"`

	Name    string `json:"name" ddb:"name"`
	Status  int    `json:"status" ddb:"status"`
	Content string `json:"content" ddb:"content"`
}

type BannerOption struct {
	Id int `form:"id"`
}

func (banner *Banner) Fields() []string {
	return []string{"id", "name", "content", "status"}
}
