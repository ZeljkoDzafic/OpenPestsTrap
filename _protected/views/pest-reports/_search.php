<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PestReportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pest-reports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'num_of_pests') ?>

    <?= $form->field($model, 'num_of_pests_total') ?>

    <?= $form->field($model, 'date_time') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'trap_id') ?>

    <?php // echo $form->field($model, 'is_reset') ?>

    <?php // echo $form->field($model, 'pest_family') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
