package http

import (
	"bytes"
	"chenChat/pkg/utils"
	"context"
	"encoding/json"
	"fmt"
	"net/http"
	"net/url"
	"time"
)

type HTTPClient struct {
	Handle *http.Client
	Header map[string]string
	Timeout time.Duration
	params map[string]string
}

func NewHTTPClient() *HTTPClient {
	header := map[string]string{
		"Content-Type":"application/json",
		"Accept":"application/json",
	}

	return &HTTPClient{
		Handle:  &http.Client{},
		Header:  header,
		Timeout: time.Duration( 6 * time.Second),
	}
}

func (client *HTTPClient) setTimeOut(time time.Duration) *HTTPClient {
	client.Timeout =  time

	return client
}

func (client *HTTPClient)Do(ctx context.Context, method string, httpUrl string) (response *http.Response, err error)  {
	methods := []interface{}{"GET", "PUT", "POST", "DELETE"}
	if method == "" || !utils.InArray(method, methods) {
		err := fmt.Errorf("method is not vliad")
		return nil, err
	}

	if httpUrl == "" {
		err := fmt.Errorf("url empty")
		return nil, err
	}

	var req *http.Request
	if method != "GET" {
		payload, _ := client.buildPayload(client.params)
		req, _ = http.NewRequestWithContext(ctx, method, httpUrl, bytes.NewBuffer(payload))
	} else {
		req, _ = http.NewRequestWithContext(ctx, method, httpUrl, nil)

		if client.params != nil {
			query  := url.Values{}
			for k, v := range client.params {
				query.Add(k, v)
			}

			req.URL.RawQuery = query.Encode()
		}
	}

	if len(client.Header) > 0 {
		for k, v := range client.Header {
			req.Header.Set(k, v)
		}
	}

	return client.Handle.Do(req)
}

func (client *HTTPClient) buildPayload(data map[string]string) (payload []byte, err error) {
	switch client.Header["Content-Type"] {
	case "application/json":
		payload, err := json.Marshal(data)
		return payload,err

	case "application/x-www-form-urlencoded":
		url := url.URL{}
		q := url.Query()
		for k, v := range data {
			q.Add(k, v)
		}

		payload := q.Encode()

		return []byte(payload), nil
	default:
		err := fmt.Errorf("unkown type")
		return  nil, err
	}
}




