<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PestReports */

$this->title = 'Create Pest Reports';
$this->params['breadcrumbs'][] = ['label' => 'Pest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pest-reports-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'traps' => $traps,
        'pestFamilies' => $pestFamilies
    ]) ?>

</div>
