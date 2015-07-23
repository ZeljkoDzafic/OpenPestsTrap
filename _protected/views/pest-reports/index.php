<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PestReportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pest Reports';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="pest-reports-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pest Reports', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'num_of_pests',
            'num_of_pests_total',
            'date_time',
            'created_at',
            // 'updated_at',
            // 'trap_id',
             'is_reset',
            [
                'attribute' => 'Pest Family',
                'value' => 'pest_family.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
