<?php
require_once "../classi/timer.php";

$timer = Timer::getInstance();


echo $timer->getSecond();