<?php if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options

return [
    // Captcha configuration for example page
    'RegisterPageCaptcha' => [
        'UserInputID' => 'CaptchaCode',
        'ImageWidth' => 250,
        'ImageHeight' => 50,
    ],

];