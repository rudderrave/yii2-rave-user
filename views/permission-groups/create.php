<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var ravesoft\models\AuthItemGroup $model
 */

$this->title = Yii::t('rave/user', 'Create Permission Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Users'), 'url' => ['/user/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Permission Groups'), 'url' => ['/user/permission-groups/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="permission-groups-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>
