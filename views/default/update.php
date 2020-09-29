<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var ravesoft\models\User $model
 */
$this->title = Yii::t('rave/user', 'Update User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="user-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>