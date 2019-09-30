<?php
namespace Middlewares;
use Naka507\Koa\Middleware;
use Naka507\Koa\Context;
class Cors implements Middleware
{
    public function __construct(){}
    public function __invoke(Context $ctx, $next)
    {
        $http_origin = isset($ctx->server['http_origin']) ? $ctx->server['http_origin'] : "*";
        $ctx->res->header("Access-Control-Allow-Origin", $http_origin);
        $ctx->res->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS");
        $ctx->res->header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, authorization");

        if ( $ctx->method == 'OPTIONS' ) {
            $ctx->status = 204;
            $ctx->body = '';
            return;
        }
        yield $next;
    }
}