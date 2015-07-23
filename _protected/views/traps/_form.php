<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Traps */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="traps-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pests_network_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'battery_charge')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startdate')->widget(DateTimePicker::className(), [
    'pickButtonIcon' => 'glyphicon glyphicon-time',
    'clientOptions' => [
        'minView' => 0,
        'maxView' => 1,
        'autoclose' => true,
        //'linkFormat' => 'HH:ii P', // if inline = true
        'format' => 'yyyy-mm-dd hh:mm:ss', // if inline = false
        'todayBtn' => true
    ]
]);?>

    <?= $form->field($model, 'enddate')->widget(DateTimePicker::className(), [
    'pickButtonIcon' => 'glyphicon glyphicon-time',
    'clientOptions' => [
        'minView' => 1,
        'autoclose' => true,
        //'linkFormat' => 'HH:ii P', // if inline = true
        'format' => 'yyyy-mm-dd hh:mm:ss', // if inline = false
        'todayBtn' => true,
        'todayHighlight' => true,
        'initialDate' => 'today'
    ]
]);?>

    <?= $form->field($model, 'status')->dropDownList([ 'PAUSED' => 'PAUSED', 'ACTIVE' => 'ACTIVE', 'DELETED' => 'DELETED', 'BLOCKED' => 'BLOCKED', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->widget(DateTimePicker::className(), [
    'pickButtonIcon' => 'glyphicon glyphicon-time',
    'clientOptions' => [
        'minView' => 1,
        'autoclose' => true,
        //'linkFormat' => 'HH:ii P', // if inline = true
        'format' => 'yyyy-mm-dd hh:mm:ss', // if inline = false
        'todayBtn' => true,
        'todayHighlight' => true,
        'initialDate' => 'today'
    ]
]);?>

    <?= $form->field($model, 'is_running')->checkbox(); ?>

    <?= $form->field($model, 'is_public')->checkbox(); ?>

    <?= $form->field($model, 'error_code')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
