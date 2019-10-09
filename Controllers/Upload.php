<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\Files;
class Upload
{
    public static function theme(Context $ctx, $next, $var){
        $ctx->status = 401;
        if( !isset($var[0]) || !isset($ctx->get['filetype']) ){
            $ctx->body = '';
            return;
        }

        $data = ( yield Files::all( ['themeId'=> $var[0],'fileType'=> $ctx->get['filetype']]) );
        foreach($data as $key=>$value){
            $value->_id = $value->id;
        }
        $ctx->status = 200;
        $ctx->body = $data;
    }    
}