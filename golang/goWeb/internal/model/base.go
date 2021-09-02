package model

type Pagination struct {
	NoPage   int `json:"no_page,omitempty"`
	Page     int `json:"page,omitempty"`
	PageSize int `json:"page,omitempty"`
}
