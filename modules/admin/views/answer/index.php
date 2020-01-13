<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запитання та відповіді';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити запитання', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
	        [
		        'attribute' => 'test_id',
		        'value' => function($data) {
			        return $data->test->name ?? 'Немає';
		        }
	        ],
            'name',
            'value:ntext',
            'correct',
            //'balls',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
