<?php


namespace Elijahcruz\Laralytics\Jobs;

use Elijahcruz\Laralytics\Models\Laralytics;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class StoreAnalyticsMysql implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * @var string|null
     */
    public string|null $ip;
    
    /**
     * @var string
     */
    public string $path;
    
    /**
     * @var int
     */
    public int $time;
    
    /**
     * StoreAnalyticsMysql constructor.
     * @param  string  $path
     * @param  int  $time
     * @param  string|null  $ip
     */
    public function __construct(string $path, int $time, null|string $ip){
        $this->path = $path;
        
        $this->time = $time;
        
        $this->ip = $ip;
    }
    
    /**
     * @throws \Throwable
     */
    public function handle(){
        $time = Carbon::createFromTimestamp($this->time);
        
        $data = [
            'ip' => $this->ip,
        ];
        
        $analytic = new Laralytics;
        
        $analytic->path = $this->path;
        
        $analytic->realtime = $time;
        
        $analytic->data = json_encode($data);
        
        $analytic->saveOrFail();
    }
}

