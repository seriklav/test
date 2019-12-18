<?php
/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\HistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\jui\DatePicker; ?>
<div class="text-center">
	<strong>БАЛЫ: <span class="label label-success"><?= Yii::$app->user->identity->rating ?></span></strong>
</div>
<h2>Пройденные тесты</h2>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],
		[
			'attribute' => 'test_name',
			'value' => function($data) {
				return $data->test->name;
			}
		],
		'balls',
		[
			'attribute' => 'created_at',
			'format' => ['date', 'php:Y-m-d H:i:s'],
			'filter' => DatePicker::widget([
				'model' => $searchModel,
				'attribute' => 'created_at',
				'dateFormat' => 'yyyy-MM-dd',
				'options' => ['class' => 'form-control', 'placeholder' => 'Дата прохождения...']
			])
		],
	],
]); ?>

