<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Article */
/* @var $category app\modules\admin\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'category_id')->dropDownList($category->tree, [
		'prompt' => [
			'text' => 'Нет категории',
			'options' => [
				'value' => '0'
			]
		]
	]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<?=
		$form->field($model, 'description')->widget(CKEditor::className(), [
			'editorOptions' => ElFinder::ckeditorOptions(['elfinder', []]),
		]);
	?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
