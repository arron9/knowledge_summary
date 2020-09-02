<?php
/**
 * Created by PhpStorm.
 * User: jiangsx
 * Date: 2020/8/26 0026
 * Time: 下午 3:33
 */

namespace App\Algorithmic\Sorts;


class Sort
{
    private $data = [3,1,2,4,5,11,7,65,9];

    public function bubble()
    {
        $cnt = count($this->data) - 1;
        for($i = 0; $i <= $cnt; $i++) {
            for($j = $i + 1; $j <= $cnt; $j++) {
                if ($this->data[$i] > $this->data[$j]) {
                    $tmp = $this->data[$i];
                    $this->data[$i] = $this->data[$j];
                    $this->data[$j] = $tmp;
                }
            }
        }

        return $this;
    }

    public function select()
    {
        $cnt = count($this->data) - 1;
        for($i = 0; $i <= $cnt; $i++) {
            $p = $i;
            for($j = $i+1; $j <= $cnt; $j++) {
                if ($this->data[$p] > $this->data[$j]) {
                    $p = $j;
                }
            }

            if ($p != $i) {
                $tmp = $this->data[$i];
                $this->data[$i] = $this->data[$p];
                $this->data[$p] = $tmp;
            }
        }

        return $this;
    }

    public function insert()
    {
        $cnt = count($this->data);
        for($i = 1; $i < $cnt; $i++) {
            $val = $this->data[$i];
            for($j = $i - 1; $j >= 0; $j--) {
                if ($val < $this->data[$j]) {
                    $this->data[$j+1] = $this->data[$j];
                } else {
                    break;
                }
            }

            $this->data[$j + 1] = $val;
        }

        return $this;
    }

    public function quick($data)
    {
        if (!isset($data[1])) {
            return $data;
        }

        $pvoit = $data[0];
        $left = [];
        $right =  [];

        foreach ($data as $v) {
            if ($v > $pvoit) {
                $right[] = $v;
            } elseif ($v < $pvoit) {
                $left[] = $v;
            }
        }

        $left = $this->quick($left);
        $left[] = $pvoit;
        $right = $this->quick($right);

        return array_merge($left, $right);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

}
