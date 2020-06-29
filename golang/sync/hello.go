package main

import sync2 "sync"

func main() {
	var mutex sync2.Mutex
	mutex.Lock()
	go func() {
		println("你好, 世界")
		mutex.Unlock()
	}()

	mutex.Lock()
}
