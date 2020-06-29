package main

import "fmt"

func exec(a int, b int, add func(a, b int) int) int {
	return add(a, b)
}

func add(a int, b int) int {
	return a + b
}

func main() {
	c := exec(1, 1, add)
	fmt.Print(c)
}
