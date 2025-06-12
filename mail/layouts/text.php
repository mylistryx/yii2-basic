<?php

/**
 * @var View $this
 * @var BaseMessage $message
 * @var string $content
 */

use yii\mail\BaseMessage;
use yii\web\View;

$this->beginPage();
$this->beginBody();
echo $content;
$this->endBody();
$this->endPage();
