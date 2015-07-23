<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TrapNetworks */

$this->title = 'Create Trap Networks';
$this->params['breadcrumbs'][] = ['label' => 'Trap Networks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trap-networks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
