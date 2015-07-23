<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Traps */

$this->title = 'Create Traps';
$this->params['breadcrumbs'][] = ['label' => 'Traps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
