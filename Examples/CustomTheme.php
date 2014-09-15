<?php
/**
 * You must run `composer install` in order to generate autoloader for this example
 */
require __DIR__ . '/../vendor/autoload.php';

// New captcha instance
$captcha = new Captcha\Captcha();
$captcha->setPublicKey('publickey');
$captcha->setPrivateKey('privatekey');
$captcha->setTheme('custom');
$captcha->setCustomTheme('myCustomTheme');

$theme_html = <<<EOD

    <div id="recaptcha_widget" style="display:none">

        <div id="recaptcha_image"></div>
        <div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect please try again</div>

        <span class="recaptcha_only_if_image">Enter the words above:</span>
        <span class="recaptcha_only_if_audio">Enter the numbers you hear:</span>

        <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />

        <div><a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a></div>
        <div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
        <div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>

        <div><a href="javascript:Recaptcha.showhelp()">Help</a></div>

    </div>


EOD;


// set a remote IP if the remote IP can not be found via $_SERVER['REMOTE_ADDR']
if (!isset($_SERVER['REMOTE_ADDR'])) {
    $captcha->setRemoteIp('192.168.1.1');
}


// Output captcha to end user
echo $captcha->html();

// Perform validation (put this inside if ($_POST) {} condition for example)
$response = $captcha->check();
if (!$response->isValid()) {
    echo $response->getError();
}

