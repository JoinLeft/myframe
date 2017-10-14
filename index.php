<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2017/10/13
 * Time: 17:56
 */
require "vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
$log = new Logger('name');
$log->pushHandler(new StreamHandler('your.log', Logger::WARNING));
$log->warn('Foo');
$log->err('Bar');
//测试