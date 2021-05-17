<?php

namespace Elijahcruz\Laralytics;

use Elijahcruz\Laralytics\Models\Laralytics as LaralyticsAlias;
use Illuminate\Support\Facades\Redis;

class Laralytics
{
    
    /**
     * @var int
     */
    public int $timesVisited = 0;
    
    /**
     * @var mixed
     */
    public mixed $info;
    
    /**
     * @param  string  $path
     */
    public function getInfoViaPath(string $path) {
        switch (config('laralytics.store')) {
            case 'redis':
                $this->timesVisited = Redis::get('laralytics:' . $path . ':times-visited');
                break;
            case 'mysql':
                $this->info = LaralyticsAlias::where('path', $path)->get();
        }
    }
    
    public function first() {
        $this->info = $this->info->first();
    }
}
