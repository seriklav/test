<?php

use yii\bootstrap\Collapse;
use yii\helpers\Html;

?>
<h2>Вопросы и ответы к тесту "<?= $model->name ?>"</h2>

<?php if ($model->answers): ?>
	<?php $items = []; ?>

	<?php foreach ($model->answers as $key => $answer): ?>
		<?php
		if ($key == 0) {
			$contentOptions = ['class' => 'in'];
		} else {
			$contentOptions = [];
		}
		$content = [];


		$values = json_decode($answer->value, true);
		foreach ($values as $key_v => $value):
			$content[] = $value . ' ' . (($key_v+1 == $answer->correct) ? '<span class="label label-success">Правильный</span>' : '<span class="label label-danger">Не правильный</span>');
		endforeach;

		$items[] = [
			'label' => $answer->name,
			'content' => $content,
			'contentOptions' => $contentOptions,
			'footer' => Html::a('<span class="glyphicon glyphicon-pencil"></span> Редактировать', ['/admin/answer/update', 'id' => $answer->id], ['class' => 'btn btn-info'])
		];

		?>
	<?php endforeach; ?>

	<?= Collapse::widget(['items' => $items]) ?>
<?php endif; ?>

<p><?= Html::a('<span class="glyphicon glyphicon-plus"></span> Добавить вопрос', ['/admin/answer/create', 'test_id' => $model->id], ['class' => 'btn btn-primary btn-lg']) ?></p>