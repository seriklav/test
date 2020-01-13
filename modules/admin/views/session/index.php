<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Хто онлайн';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
	        [
		        'attribute' => 'first_name',
		        'value' => function($data) {
			        return $data->user->first_name;
		        }
	        ],
	        [
		        'attribute' => 'last_name',
		        'value' => function($data) {
			        return $data->user->last_name;
		        }
	        ],
	        [
		        'attribute' => 'email',
		        'value' => function($data) {
			        return $data->user->email;
		        }
	        ],
            'last_activity',
            'last_ip',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
