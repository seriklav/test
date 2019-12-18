<?php

use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Test */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Тесты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="test-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
	        [
		        'attribute' => 'status',
		        'format' => 'raw',
		        'value' => function($data) {
			        return $data->status ? '<span class="label label-success">Включен</span>' : '<span class="label label-danger">Отключен</span>';
		        }
	        ],
            'viewed',
            'created_at',
            'update_at',
        ],
    ]) ?>

	<?= $this->render('_answers', [
			'model' => $model
		]);
	?>

</div>
