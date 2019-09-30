<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\User;
class Auth
{
    public static function login(Context $ctx, $next){
        $ctx->status = 401;
        if( !isset($ctx->post['loginid']) || !isset($ctx->post['password']) ){
            $ctx->body = '';
            return;
        }
        
        $data = ( yield User::get(['loginId'=> $ctx->post['loginid']]) );
        if (!$data || $data->authenticate($ctx->post['password']) ) {
            $ctx->body = '';
            return;
        }
        $ctx->status = 200;
        $ctx->body = $data;
    }   
    
    
    public function register(Context $ctx, $next){
        $ctx->status = 401;
        if( !isset($ctx->post['name']) || !isset($ctx->post['loginid']) || !isset($ctx->post['password']) ){
            $ctx->body = '';
            return;
        }

        $data = ( yield User::get(['name'=> $ctx->post['name']]) );

        if ( $data ) {
            $ctx->body =  '';
            return;
        }

        $user = new User();
        $user->name = $ctx->post['name'];
        $user->loginId = $ctx->post['loginid'];
        $user->password = $ctx->post['password'];

        $data = $user->save();

        if (!$data) {
            $ctx->body =  '';
            return;
        }
        
        $ctx->status = 200;
        $ctx->body = $data;
    }
}