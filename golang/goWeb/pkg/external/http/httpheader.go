package http

func (client *HTTPClient)SetFormContentType() *HTTPClient {
	client.Header["Content-Type"] = "application/x-www-form-urlencoded"
	return client
}

func (client *HTTPClient)SetJsonContentType() *HTTPClient {
	client.Header["Content-Type"] = "application/json"

	return client
}

func (client *HTTPClient)SetAcceptJson() *HTTPClient {
	client.Header["Accept"] = "application/json"

	return client
}

func (client *HTTPClient)SetCustomHeader(headers map[string]string) *HTTPClient {
	if len(headers) <= 0 {
		return client
	}

	for k, v := range headers {
		client.Header[k] = v
	}

	return client
}

func (client *HTTPClient)SetParams(data map[string]string) *HTTPClient {
	client.params = data
	return client
}


