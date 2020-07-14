<?php
class HelloWorld
{
    function index()
    {
        echo "hello world";
    }
}

echo (new HelloWorld())->index();
