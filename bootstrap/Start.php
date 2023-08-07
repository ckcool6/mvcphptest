<?php

class Start
{
    static public $auto;

    static function init()
    {
        self::$auto = new Psr4AutoLoad();
    }

    static function router()
    {
        $m = empty($_GET['m']) ? 'index' : $_GET['m'];
        $a = empty($_GET['a']) ? 'index' : $_GET['a'];

        $_GET['m'] = $m;
        $_GET['a'] = $a;

        $m = ucfirst(strtolower($m));

        $controller = 'controller\\' . $m . 'Controller';
        $obj = new $controller();

        call_user_func([$obj, $a]);
    }
}