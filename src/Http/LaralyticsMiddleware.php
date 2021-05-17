<?php


namespace Elijahcruz\Laralytics\Http;

use Closure;
use Elijahcruz\Laralytics\Jobs\StoreAnalyticsRedis;

class LaralyticsMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!config('laralytics.active')){
            return $next($request);
        }
        
        $time = time();
        
        $uri = $request->path();
    
        // TODO: Add config variable to exclude specific paths
    
        if(strpos($uri, 'laralytics')){
            return $next($request);
        }
        
        if(config('laralytics.keep-ip')){
            if(config('laralytics.proxy')){
                if($_SERVER['X-Forwarded-For'] != null){
                    $ip = $_SERVER['X-Forwarded-For'];
                }
                else{
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
            }
            else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            
            if(strpos($ip, ':')){
                //IPv6
                $replace_num = strrpos($ip, ':') - strlen($ip) + 1;
                $ip = substr_replace($ip, 'xxxx', $replace_num);
            }
            else{
                //IPv4
                $replace_num = strrpos($ip, '.') - strlen($ip) + 1;
                $ip = substr_replace($ip, 'xxx', $replace_num);
            }
        }
        else{
            $ip = '0.0.0.xxx';
        }
        
        switch (config('laralytics.method')) {
            case 'queue':
                // Mysql Job
                break;
            case 'queue-redis':
                StoreAnalyticsRedis::dispatch($uri, $time, $ip)->onQueue(config('laralytics.queue'));
                break;
            case 'redis':
                // do it now
                break;
            case 'mysql':
                // do it now
                break;
        }
        
        return $next($request);
    }
}
