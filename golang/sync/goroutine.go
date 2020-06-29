package main

import (
	"fmt"
	"sync"
)

var a string
var metux sync.Mutex

func f() {
	fmt.Print(a)
	metux.Unlock()
}

func hello() {
	metux.Lock()
	a = "hello, world"
	metux.Unlock()
	metux.Lock()
	go f()
}

func main() {
	hello()
	metux.Lock()
}
