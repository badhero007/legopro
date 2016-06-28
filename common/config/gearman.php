<?php
return [
        'class' => 'shakura\yii2\gearman\GearmanComponent',
        'servers' => [
            'main'=>['host' => '127.0.0.1', 'port' => 4730],
            'slave'=>['host' => '', 'port' => 0],
        ],
        'user' => 'legolas', //测试线配置
        'jobs' => [
            'GearmanTest' => [
                'class' => 'lego\job\handler\GearmanTest'
            ],
            //... other test jobs
        ],
]
?>