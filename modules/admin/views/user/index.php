<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Користувачі';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити користувача', ['create'], ['class' => 'btn btn-success']) ?>
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
		        'filter' => ['0' => 'Користувач', '1' => 'Адміністратор'],
		        'value' => function($data) {
			        return $data->role ? '<span class="label label-warning">Адміністратор</span>' : '<span class="label label-success">Користувач</span>';
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
			        'options' => ['class' => 'form-control', 'placeholder' => 'Дата створення...']
		        ])
	        ],
	        [
		        'attribute' => 'update_at',
		        'format' => ['date', 'php:Y-m-d H:i:s'],
		        'filter' => DatePicker::widget([
			        'model' => $searchModel,
			        'attribute' => 'update_at',
			        'dateFormat' => 'yyyy-MM-dd',
			        'options' => ['class' => 'form-control', 'placeholder' => 'Дата оновлення...']
		        ])
	        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
