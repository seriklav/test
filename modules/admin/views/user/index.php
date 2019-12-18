<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'first_name',
            'last_name',
	        [
		        'attribute' => 'role',
		        'format' => 'raw',
		        'filter' => ['0' => 'Пользователь', '1' => 'Администратор'],
		        'value' => function($data) {
			        return $data->role ? '<span class="label label-warning">Администратор</span>' : '<span class="label label-success">Пользователь</span>';
		        }
	        ],
            'rating',
	        [
		        'attribute' => 'created_at',
		        'format' => ['date', 'php:Y-m-d H:i:s'],
		        'filter' => DatePicker::widget([
			        'model' => $searchModel,
			        'attribute' => 'created_at',
			        'dateFormat' => 'yyyy-MM-dd',
			        'options' => ['class' => 'form-control', 'placeholder' => 'Дата создания...']
		        ])
	        ],
	        [
		        'attribute' => 'update_at',
		        'format' => ['date', 'php:Y-m-d H:i:s'],
		        'filter' => DatePicker::widget([
			        'model' => $searchModel,
			        'attribute' => 'update_at',
			        'dateFormat' => 'yyyy-MM-dd',
			        'options' => ['class' => 'form-control', 'placeholder' => 'Дата обновления...']
		        ])
	        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
