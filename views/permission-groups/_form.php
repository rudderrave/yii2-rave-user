<?php

use ravesoft\helpers\Html;
use ravesoft\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var ravesoft\models\AuthItemGroup $model
 * @var ravesoft\widgets\ActiveForm $form
 */
?>

<div class="permission-groups-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'permission-groups-form',
        'validateOnBlur' => false,
    ])
    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus' => $model->isNewRecord ? true : false]) ?>
                    <?= $form->field($model, 'code')->textInput(['maxlength' => 64]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        <div class="form-group">
                            <?php if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('rave', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('rave', 'Cancel'), ['/user/permission-groups/index'], ['class' => 'btn btn-default']) ?>
                            <?php else: ?>
                                <?= Html::submitButton(Yii::t('rave', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('rave', 'Delete'), ['delete', 'id' => $model->code], [
                                    'class' => 'btn btn-default',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ])
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>






