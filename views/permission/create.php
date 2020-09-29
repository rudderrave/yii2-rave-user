<?php
/**
 *
 * @var yii\web\View $this
 * @var ravesoft\widgets\ActiveForm $form
 * @var ravesoft\models\Permission $model
 */

use yii\helpers\Html;

$this->title = Yii::t('rave/user', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Users'), 'url' => ['/user/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('rave/user', 'Permissions'), 'url' => ['/user/permission/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="permission-create">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>