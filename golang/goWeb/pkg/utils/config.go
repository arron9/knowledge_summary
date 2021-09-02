package utils

import (
	"gopkg.in/yaml.v2"
	"os"
)

func LoadConfig(filename string, config interface{}) {
	dir, _ := os.Getwd()
	path := dir + "\\configs\\" + filename
	if file, err := os.Open(path); err != nil {
		panic(err)
	} else {
		_ = yaml.NewDecoder(file).Decode(config)
	}
}
