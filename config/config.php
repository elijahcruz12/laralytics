<?php
return [
    
    /*
     * If this is not set to true, Laralytics' Middleware, even if activated, will not run,
     * causing Laralytics to not run in general.
     */
    'active' => env('LARALYTICS', false),
    
    /*
     * Set the method for storing the analytics
     *
     * Options are: queue, queue-redis, mysql, redis
     *
     * If you choose queue, will be stored in your mysql database.
     * If you choose mysql or redis, it will store during the request.
     */
    'method' => env('LARALYTICS_METHOD', 'queue'),
    
    /*
     * If you don't want your queue to be running on the default queue, set this.
     */
    'queue' => env('LARALYTICS_QUEUE', 'default'),
    
    /*
     * You need to set this so Laralytics knows where to look for your analytics.
     */
    'store' => env('LARALYTICS_STORE', 'mysql'),
    
    /*
     * If this is set to true, your Laralytics will also store the IP Address of your users, however
     * it won't store it all to protect your users privacy (eg. 192.168.1.xxx or 1:2:3:4:5:7:8:XXXX)
     *
     * We recommend to leave this set to false as it helps ensure your users privacy.
     */
    'ip' => env('LARALYTICS_KEEP_IP', false),
    
    /*
     * Set this to true if you have your site behind a proxy and you are storing IP Adresses.
     */
    'proxy' => ENV('LARALYTICS_PROXY', false),
];
