<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\User;
class Upload
{
    public static function theme(Context $ctx, $next){
        var_dump('theme');
    }    
}