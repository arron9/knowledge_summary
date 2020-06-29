package main

import (
	"fmt"
	"time"
)

func main() {
	var fillInterval = time.Millisecond * 10
	var capacity = 100
	var tokenBucket = make(chan struct{}, capacity)

	fillToken := func() {
		ticker := time.NewTicker(fillInterval)
		for {
			select {
			case <-ticker.C:
				select {
				case tokenBucket <- struct{}{}:
				default:
				}
				fmt.Println("current token cnt:", len(tokenBucket), time.Now())
			}
		}
	}

	takeToken := func() {
		for {
			select {
			case c := <-tokenBucket:
				fmt.Print(c)
				fmt.Println("get token cnt:", len(tokenBucket), time.Now())
				time.Sleep(20)
			default:
			}
		}

	}

	go fillToken()
	go takeToken()
	time.Sleep(time.Hour)
	println("hello world")
}
