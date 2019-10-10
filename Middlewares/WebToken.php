<?php
namespace Middlewares;
use Naka507\Koa\Middleware;
use Naka507\Koa\Context;
use Naka507\Koa\HttpException;
class WebToken implements Middleware
{
    public static $secret;
    public static $filter = [];
    public function __construct($secret,$filter=[]){
        WebToken::$secret = $secret;
        WebToken::$filter = $filter;
    }
    public function __invoke(Context $ctx, $next)
    {
        $url = explode('?',$ctx->url);
        if ( in_array($url[0],WebToken::$filter) ) {
            yield $next;
            return;
        }

        $authorization = isset($ctx->server['http_authorization']) ? explode(' ',$ctx->server['http_authorization']) : "";
        $token = isset($authorization[1]) ? $authorization[1] : "";

        if ( empty($token) ) {
            throw new HttpException(401,"authorization is empty",'000004');
            return;
        }

        $user = WebToken::decode($token);
        if ( !$user ) {
            $ctx->status = 200;
            $ctx->body = '';
            return;
        }
        $ctx->state['user'] = $user;
        yield $next;
    }

    public static function decode($token){
        $str = base64_decode($token); 
        $str = mcrypt_decrypt(MCRYPT_DES, WebToken::$secret, $str, MCRYPT_MODE_ECB); 
        $block = mcrypt_get_block_size('des', 'ecb'); 
        $pad = ord($str[($len = strlen($str)) - 1]); 
        if ($pad && $pad < $block && preg_match('/' . chr($pad) . '{' . $pad . '}$/', $str)) { 
            $str = substr($str, 0, strlen($str) - $pad); 
        } 
        return unserialize($str); 
    }

    public static function encode($data){
        $prep_code = serialize($data); 
        $block = mcrypt_get_block_size('des', 'ecb'); 
        if (($pad = $block - (strlen($prep_code) % $block)) < $block) { 
            $prep_code .= str_repeat(chr($pad), $pad); 
        } 
        $token = mcrypt_encrypt(MCRYPT_DES, WebToken::$secret, $prep_code, MCRYPT_MODE_ECB); 
        return base64_encode($token); 
    }
    
}