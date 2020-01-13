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
		        'format' => 'raw',
		        'value' => function($data) {
			        return !empty($data->user->first_name) ? $data->user->first_name : '<span class="label label-danger">Гість</span>';
		        }
	        ],
	        [
		        'attribute' => 'last_name',
		        'format' => 'raw',
		        'value' => function($data) {
			        return !empty($data->user->last_name) ? $data->user->last_name : '<span class="label label-danger">Гість</span>';
		        }
	        ],
	        [
		        'attribute' => 'email',
		        'format' => 'raw',
		        'value' => function($data) {
			        return !empty($data->user->email) ? $data->user->email : '<span class="label label-danger">Гість</span>';
		        }
	        ],
	        [
		        'attribute' => 'last_activity',
		        'format' => 'raw',
		        'value' => function($data) {
    	            $last_activity = strtotime($data->last_activity) + strtotime('+360 seconds');

    	            if ($last_activity >= strtotime('now')) {
		                return '<span class="label label-success">Онлайн</span>';
	                }  else {
				        return $data->last_activity;
			        }
		        }
	        ],
            'last_ip',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
