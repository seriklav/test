<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Вход';
?>
<div class="site-login">
	<h1 class="text-center"><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'layout' => 'horizontal',
		'action' => '/site/login',
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-sm-8\">{input}</div>\n<div class=\"col-sm-12\">{error}</div>",
			'labelOptions' => ['class' => 'col-sm-4 control-label'],
		],
	]); ?>

	<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

	<?= $form->field($model, 'password')->passwordInput() ?>

	<div class="form-group">
		<div class="col-sm-12">
			<?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>
</div>
