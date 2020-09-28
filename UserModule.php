<?php

namespace ravesoft\user;

/**
 * Class UserModule
 * @package ravesoft\user
 */
class UserModule extends \yii\base\Module
{
    /**
     * Version number of the module.
     */
    const VERSION = '0.1.0';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'ravesoft\user\controllers';

}