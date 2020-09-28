<?php

namespace ravesoft\user\controllers;

use ravesoft\controllers\admin\BaseController;

/**
 * UserVisitLogController implements the CRUD actions for UserVisitLog model.
 */
class VisitLogController extends BaseController
{
    /**
     *
     * @inheritdoc
     */
    public $modelClass = 'ravesoft\models\UserVisitLog';

    /**
     *
     * @inheritdoc
     */
    public $modelSearchClass = 'ravesoft\user\models\search\UserVisitLogSearch';

    /**
     *
     * @inheritdoc
     */
    public $enableOnlyActions = ['index', 'view', 'grid-page-size'];

}