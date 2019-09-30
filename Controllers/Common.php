<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\User;
class Common
{
    public static function miss(Context $ctx, $next){
        var_dump('miss');
    }    
}