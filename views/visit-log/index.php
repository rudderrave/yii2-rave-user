<?php

use webvimark\extensions\DateRangePicker\DateRangePicker;
use ravesoft\grid\GridPageSize;
use ravesoft\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var ravesoft\user\models\search\UserVisitLogSearch $searchModel
 */

$this->title = Yii::t('yee/user', 'Visit Log');
$this->params['breadcrumbs'][] = ['label' => Yii::t('yee/user', 'Users'), 'url' => ['/user/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="user-visit-log-index">

        <div class="row">
            <div class="col-sm-12">
                <h3 class="lte-hide-title page-title"><?= Html::encode($this->title) ?></h3>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-12 text-right">
                        <?= GridPageSize::widget(['pjaxId' => 'user-visit-log-grid-pjax']) ?>
                    </div>
                </div>

                <?php
                Pjax::begin([
                    'id' => 'user-visit-log-grid-pjax',
                ])
                ?>

                <?=
                GridView::widget([
                    'id' => 'user-visit-log-grid',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'bulkActions' => ' ',
                    'columns' => [
                        [
                            'attribute' => 'user_id',
                            'class' => 'ravesoft\grid\columns\TitleActionColumn',
                            'controller' => '/user/visit-log',
                            'title' => function ($model) {
                                return Html::a(@$model->user->username,
                                    ['view', 'id' => $model->id], ['data-pjax' => 0]);
                            },
                            'buttonsTemplate' => ''
                        ],
                        'language',
                        'os',
                        'browser',
                        array(
                            'attribute' => 'ip',
                            'value' => function ($model) {
                                return Html::a($model->ip,
                                    "http://ipinfo.io/" . $model->ip,
                                    ["target" => "_blank"]);
                            },
                            'format' => 'raw',
                        ),
                        [
                            'attribute' => 'visit_time',
                            'value' => function ($model) {
                                return $model->visitDatetime;
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'contentOptions' => ['style' => 'width:70px; text-align:center;'],
                        ],
                        /* [
                          'attribute' => 'author_id',
                          'filter' => ravesoft\models\User::getUsersList(),
                          'value' => function(Post $model) {
                          return Html::a($model->author->username,
                          ['user/view', 'id' => $model->author_id],
                          ['data-pjax' => 0]);
                          },
                          'format' => 'raw',
                          'options' => ['style' => 'width:180px'],
                          ],
                          [
                          'class' => 'ravesoft\grid\columns\StatusColumn',
                          'attribute' => 'status',
                          'optionsArray' => Post::getStatusOptionsList(),
                          'options' => ['style' => 'width:60px'],
                          ],
                          [
                          'class' => 'ravesoft\grid\columns\DateFilterColumn',
                          'attribute' => 'published_at',
                          'value' => function(Post $model) {
                          return '<span style="font-size:85%;" class="label label-'
                          .((time() >= $model->published_at) ? 'primary' : 'default').'">'
                          .$model->publishedDate.'</span>';
                          },
                          'format' => 'raw',
                          'options' => ['style' => 'width:150px'],
                          ], */
                    ],
                ]);
                ?>

                <?php Pjax::end() ?>
            </div>
        </div>
    </div>

<?php
DateRangePicker::widget([
    'model' => $searchModel,
    'attribute' => 'visit_time',
])
?>