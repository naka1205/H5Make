<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\Pages;
class Page
{
    public static function index(Context $ctx, $next){
        $ctx->status = 401;
        var_dump('index');
        if( !isset($ctx->get['type']) ){
            $ctx->body = '';
            return;
        }

        $data = ( yield Pages::all(['type'=> $ctx->get['type']]) );
        foreach($data as $key=>$value){
            $value->_id = $value->id;
        }
        $ctx->status = 200;
        $ctx->body = $data;
    } 
    
    public static function show(Context $ctx, $next, $var){
        $ctx->status = 401;
        if( !isset($var[0]) ){
            $ctx->body = '';
            return;
        }

        $data = ( yield Pages::get(['id'=> $var[0]]) );
        $data['_id'] = $var[0];
        $ctx->status = 200;
        $ctx->body = $data;
    } 

}