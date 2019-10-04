<?php
namespace Middlewares;
use Naka507\Koa\Middleware;
use Naka507\Koa\Context;
class BodyJson implements Middleware
{
    public $type;
    public function __construct()
    {
    }
    public function __invoke(Context $ctx, $next)
    {
        yield $next;
        $pos = strpos($ctx->accept,'json');
        if ( $pos !== false ) {
            $ctx->type = 'application/json';
            $result = [ "code" => '000002',  "msg" => '操作失败'];
            $data = $ctx->body;
            
            if ( $data ) {
                $result['code'] = '000001';
                $result['msg'] = '操作成功';
                $result['data'] = $data;
            }
            $ctx->body = json_encode( $result );
        }
    }
}