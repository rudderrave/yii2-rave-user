<?php

use ravesoft\grid\GridPageSize;
use ravesoft\grid\GridView;
use ravesoft\helpers\Html;
use ravesoft\models\User;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var ravesoft\user\models\search\AuthItemGroupSearch $searchModel
 */
$this->title = Yii::t('rave/user', 'Permission Groups');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Users'), 'url' => ['/user/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="permission-groups-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('rave', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'permission-groups-grid-pjax']) ?>
                </div>
            </div>

            <?php
            Pjax::begin([
                'id' => 'permission-groups-grid-pjax',
            ])
            ?>

            <?=
            GridView::widget([
                'id' => 'permission-groups-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'permission-grid',
                    'actions' => [Url::to(['bulk-delete']) => Yii::t('rave', 'Delete')]
                ],
                'columns' => [
                    ['class' => 'ravesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'attribute' => 'name',
                        'class' => 'ravesoft\grid\columns\TitleActionColumn',
                        'controller' => '/user/permission-groups',
                        'title' => function ($model) {
                            if (User::hasPermission('manageRolesAndPermissions')) {
                                return Html::a(
                                    $model->name, ['update', 'id' => $model->code],
                                    ['data-pjax' => 0]
                                );
                            } else {
                                return $model->name;
                            }

                        },
                        'buttonsTemplate' => '{update} {delete}',
                    ],
                    'code',
                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>

































