package main

import "fmt"

func main() {
	defer fmt.Println("in main 1")
	defer func() {
		defer func() {
			panic("panic again and again22")
		}()
		panic("panic again22")
	}()
	defer func() {
		defer func() {
			panic("panic again and again")
		}()
		panic("panic again")
	}()
	defer fmt.Println("in main 2")
	panic("panic once")
}
