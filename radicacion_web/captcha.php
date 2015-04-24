<?php
session_start();
$captcha = imagecreatefromgif("images/bgcaptcha.gif");
$colText = imagecolorallocate($captcha, 0, 0, 0);
imagestring($captcha, 5, 16, 7, $_SESSION['val_cap'], $colText);

header("Content-type: image/gif");
imagegif($captcha);
?>
