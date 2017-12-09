<?php
use Yii;
use yii\web\ErrorHandler;
use yii\web\HttpException;
/* @var $exception \yii\web\HttpException|\Exception */
/* @var $handler \yii\web\ErrorHandler */
$handler = new ErrorHandler();
if ($exception instanceof \yii\web\HttpException) {
    $code = $exception->statusCode;
} else {
    $code = $exception->getCode();
}
$name = $handler->getExceptionName($exception);
if ($name === null) {
    $name = 'Error';
}
if ($code) {
    $name .= " (#$code)";
}

if ($exception instanceof \yii\base\UserException) {
    $message = $exception->getMessage();
} else {
    $message = 'An internal server error occurred.';
}
?>
<style>
    .version {
        color: gray;
        font-size: 8pt;
        border-top: 1px solid #aaa;
        padding-top: 1em;
        margin-bottom: 1em;
    }
</style>
<h1><?= $handler->htmlEncode($name) ?></h1>
<div class="alert alert-danger">
    <?= nl2br($handler->htmlEncode($message)) ?>
</div>
<p>
    The above error occurred while the Web server was processing your request.
</p>
<p>
    Please contact us if you think this is a server error. Thank you.
</p>
<div class="version">
    <?= date('Y-m-d H:i:s', time()) ?>
</div>