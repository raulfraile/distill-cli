#!/usr/bin/env php
<?php

if (version_compare(phpversion(), '5.4', '<')) {
    fwrite(STDERR, "PHP needs to be a minimum version of PHP 5.4\n");
    exit(1);
}

Phar::mapPhar('distill-cli.phar');

require_once 'phar://distill-cli.phar/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Distill\Cli\Command as DistillCommand;

$appVersion = '1.0.4';

$app = new Application('Distill CLI', $appVersion);

$app->add(new DistillCommand\ExtractCommand($appVersion));
$app->add(new DistillCommand\AboutCommand($appVersion));
$app->add(new DistillCommand\SelfUpdateCommand($appVersion));

$app->setDefaultCommand('about');

$app->run();

__HALT_COMPILER();
