<?php

// 百度开放平台相关的配置文件
return [
    'translate' => [    // 百度翻译
        'api'   => 'http://api.fanyi.baidu.com/api/trans/vip/translate?',
        'appid' => env('BAIDU_TRANSLATE_APP_ID'),
        'key'   => env('BAIDU_TRANSLATE_KEY')
    ]
];