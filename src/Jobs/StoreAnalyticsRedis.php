<?php


namespace Elijahcruz\Laralytics\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

class StoreAnalyticsRedis implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public string $ip;
    
    public string $path;
    
    public int $time;
    
    public function __construct($path, $time, $ip = null){
        $this->path = $path;
        
        $this->time = $time;
        
        $this->ip = $ip;
    }
    
    public function handle(){
        $time = Carbon::createFromTimestamp($this->time);
        
        Redis::incr('laralytics:' . $this->path . ':times-visited');
        
        Redis::set('laralytics:' . $this->path . ':' . $this->ip . ':last-visit', $time);
    }
}
