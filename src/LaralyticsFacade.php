<?php

namespace Elijahcruz\Laralytics;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elijahcruz\Laralytics\Skeleton\SkeletonClass
 */
class LaralyticsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laralytics';
    }
}
