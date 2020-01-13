<?php

use app\modules\admin\models\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статті';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Створити статтю', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
	        [
		        'attribute' => 'category_id',
		        'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
		        'value' => function($data) {
			        return $data->category->name ?? 'Немає';
		        }
	        ],
            'name',
	        [
		        'attribute' => 'description',
		        'format' => 'raw',
		        'value' => function($data) {
			        return mb_strimwidth(strip_tags($data->description), 0, 150, "...");
		        }
	        ],
            'created_at',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
