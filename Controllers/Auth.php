<?php
namespace Controllers;
use Naka507\Koa\Context;
use Models\User;

use Middlewares\WebToken; 
class Auth
{
    public static function login(Context $ctx, $next){
        $ctx->status = 401;
        if( !isset($ctx->post['loginid']) || !isset($ctx->post['password']) ){
            $ctx->body = '';
            return;
        }
        
        $user = ( yield User::get(['loginId'=> $ctx->post['loginid']]) );
        if (!$user || $user->authenticate($ctx->post['password']) ) {
            $ctx->body = '';
            return;
        }
        $data = [
            "salt" => $user->salt,
            "name" => $user->name,
            "loginId" => $user->loginId,
            "role" => $user->role,
            "id" => $user->id,
            "_id" => $user->id
        ];
        $token = WebToken::encode($data);
        $ctx->status = 200;
        $ctx->body = ['token'=>$token ];
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