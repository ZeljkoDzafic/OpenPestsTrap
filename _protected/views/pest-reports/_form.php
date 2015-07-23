<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\PestReports */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pest-reports-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_of_pests')->textInput() ?>

    <?= $form->field($model, 'num_of_pests_total')->textInput() ?>

    <?= $form->field($model, 'date_time')->widget(DateTimePicker::className(), [
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
    
    <?= $form->field($model, 'trap_id')->widget(Select2::classname(), [
        'data' => $traps,
        'options' => ['placeholder' => 'Select a trap ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'is_reset')->checkbox() ?>

    <?= $form->field($model, 'pest_family')->widget(Select2::classname(), [
        'data' => $pestFamilies,
        'options' => ['placeholder' => 'Select a pest family ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
