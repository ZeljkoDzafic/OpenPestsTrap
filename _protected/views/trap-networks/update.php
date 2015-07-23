<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TrapNetworks */

$this->title = 'Update Trap Networks: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Trap Networks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trap-networks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
