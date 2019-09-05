<?php
/**
 * ->cron('* * * * * *');    在自定义的 Cron 时间表上执行该任务
 * ->everyMinute();        每分钟执行一次任务
 * ->everyFiveMinutes();    每五分钟执行一次任务
 * ->everyTenMinutes();    每十分钟执行一次任务
 * ->everyFifteenMinutes();    每十五分钟执行一次任务
 * ->everyThirtyMinutes();    每半小时执行一次任务
 * ->hourly();    每小时执行一次任务
 * ->hourlyAt(17);    每小时的第 17 分钟执行一次任务
 * ->daily();    每天午夜执行一次任务
 * ->dailyAt('13:00');    每天的 13:00 执行一次任务
 * ->twiceDaily(1, 13);    每天的 1:00 和 13:00 分别执行一次任务
 * ->weekly();    每周执行一次任务
 * ->monthly();    每月执行一次任务
 * ->monthlyOn(4, '15:00');    在每个月的第四天的 15:00 执行一次任务
 * ->quarterly();    每季度执行一次任务
 * ->yearly();    每年执行一次任务
 * ->timezone('America/New_York');    设置时区
 */

return [
    'cron_list' =>[
        [
            'type'=>'everyMinute',//方式
            'time'=>'',//具体执行时间
            'method'=>'yier:cron App\\\\Services\\\\CronService@noticeArrivalMem',//执行的方法
        ]
    ]
];
