<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrapsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Traps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="traps-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Traps', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'pests_network_id',
            'uuid',
            'latitude',
             'longitude',
             'battery_charge',
            // 'startdate',
            // 'enddate',
            // 'status',
            // 'description:ntext',
            // 'user_id',
            // 'created_at',
            'is_running',
            'is_public',
            // 'error_code',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
