<?php
/* @var $model app\modules\admin\models\Test */
/* @var $hide boolean */

use app\components\MenuWidget;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="box">
					<h2>Категории</h2>

					<ul class="catalog category-products">
						<?= MenuWidget::widget(['tpl' => 'menu']); ?>
					</ul>

				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="body-content">
					<div class="box">
						<h2><?= $model->name ?></h2>

						<div class="blog-post">
							<p class="blog-post-meta"><?= $model->created_at ?></p>

							<?= $model->description ?>

							<?php if (!$hide): ?>
								<?php $form = ActiveForm::begin(); ?>

								<?php foreach ($model->answers as $key => $item): ?>
									<h3><?= $key+1 ?>.<?= $item->name ?></h3>

									<div class="form-group">
										<p style="margin-left: 100px;">
											<?php $answers = json_decode($item->value, true); ?>
											<?php foreach ($answers as $key_v => $answer): ?>
										<p>
											<label><input name="answer_<?= $item->id ?>" value="<?= $key_v+1 ?>" type="radio" class="form-group"> <?= $answer ?></label>
										</p>
										<?php endforeach; ?>
										</p>
									</div>

									<hr>
								<?php endforeach; ?>

								<div class="form-group">
									<?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
								</div>

								<?php ActiveForm::end(); ?>
							<?php else: ?>
								<div class="alert alert-warning">Вы уже проходили данный тест!</div>
							<?php endif; ?>
						</div><!-- /.blog-main -->
					</div>

				</div>
			</div>
		</div>
	</div>
</section>