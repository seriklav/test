<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тести';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити тест', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
	        [
		        'attribute' => 'status',
		        'format' => 'raw',
		        'filter' => ['0' => 'Виключений', '1' => 'Включений'],
		        'value' => function($data) {
			        return $data->status ? '<span class="label label-success">Включений</span>' : '<span class="label label-danger">Виключений</span>';
		        }
	        ],
            'viewed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
