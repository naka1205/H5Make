<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\Pages;
class Page
{
    public static function index(Context $ctx, $next){
        var_dump($ctx->get);
    }    
}