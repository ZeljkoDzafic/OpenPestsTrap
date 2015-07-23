<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Traps */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Traps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traps-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'pests_network_id',
            'uuid',
            'latitude',
            'longitude',
            'battery_charge',
            'startdate',
            'enddate',
            'status',
            'description:ntext',
            'user_id',
            'created_at',
            'is_running',
            'is_public',
            'error_code',
            'updated_at',
        ],
    ]) ?>

</div>
