<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Запитання та відповіді', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені що хочете видалити це?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'balls',
        ],
    ]) ?>

</div>
