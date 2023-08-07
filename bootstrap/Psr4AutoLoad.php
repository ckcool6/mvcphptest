<?php

class Psr4AutoLoad
{
    protected $maps = [];

    function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    function autoload($className)
    {
        $pos = strpos($className, '\\');
        $namespace = substr($className, 0, $pos);
        $realClass = substr($className, $pos + 1);

        $this->mapLoad($namespace, $realClass);
    }

    private function mapLoad($namespace, $realClass)
    {
        if (array_key_exists($namespace, $this->maps)) {
            $namespace = $this->maps[$namespace];
        }

        $namespace = rtrim(str_replace('\\/', '/', $namespace), '/') . '/';
        $filePath = $namespace . $realClass . '.php';

        if (file_exists($filePath)) {
            include $filePath;
        } else {
            die('file not exists');
        }
    }

    function addMaps($namespace, $path)
    {
        if (array_key_exists($namespace, $this->maps)) {
            die('已经映射');
        }

        $this->maps[$namespace] = $path;
    }
}