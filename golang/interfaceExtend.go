package main

import "fmt"

type A interface {
	TestOk() bool
}

type B interface {
	A
	ToString() string
}

type B1 struct {
}

func (b1 *B1) ToString() string {
	return "11"
}

func (b1 *B1) TestOk() bool {
	return true
}

func main() {
	fmt.Print("a is parent class of b")

	var b1 A
	b1 = new(B1)
	fmt.Print(b1.TestOk())
}
