<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

	<?php if ($model->ref_test_id): ?>
	    <?php $form = ActiveForm::begin([
		    'action' => ['/admin/answer/create', 'test_id' => $model->ref_test_id],
	    ]); ?>
	<?php else: ?>
		<?php $form = ActiveForm::begin(); ?>
	<?php endif; ?>

	<?php $model->test_id = $model->test_id ?? $model->ref_test_id; ?>
	<?= $form->field($model, 'test_id')->dropDownList(ArrayHelper::map(\app\modules\admin\models\Test::find()->all(),'id','name'), [
		'prompt' => [
			'text' => 'Без тесту',
			'options' => [
				'value' => '0'
			]
		]
	]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	<label class="control-label">Відповіді</label>
	<button type="button" class="add-field btn btn-success btn-xs "><i class="glyphicon glyphicon-plus"></i></button>
	<table class="table-container" style="width: 100%">
		<tbody class="table-body">
			<?php foreach ($model->values as $key => $value): ?>
				<tr class="table-row" id="<?= $key ?>">
					<td style="padding-bottom: 2%;"><input type="text" class="form-control" value="<?= $value ?>" name="Answer[values][<?= $key ?>]"></td>
					<td style="padding-bottom: 2%; padding-left: 1%"><button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<?= $form->field($model, 'correct')->textInput() ?>

    <?= $form->field($model, 'balls')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
	$js = <<< JS
	    $(document).ready(function() {
        $('body').on('click', '.remove-item', function(e) {
            e.preventDefault();
            if(confirm('Ви впевнені?')){
                $(this).closest('.table-row').remove();
            }
            return false;
        });
            
        $('.add-field').on('click', function() {
            var container = $(this).siblings('.table-container');
            var table = container.find('.table-body');
            var lastRow = table.find('.table-row').last();
            var id = Number(lastRow.attr('id')) + Number(1);
            if(!($.isNumeric(id))) id = 0;

  			table.append(
                '<tr class="table-row" id="'+id+'">' +
                '<td style="padding-bottom: 2%;"><input type="text" class="form-control" name="Answer[values][' + id + ']"></td>' +
                '<td style="padding-bottom: 2%; padding-left: 1%"><button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button></td>' +
                '</tr>'
            );
        });
    });
JS;

	$this->registerJs($js);
?>
