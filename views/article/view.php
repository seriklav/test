<?php
/* @var $model app\modules\admin\models\Article */

use app\components\MenuWidget; ?>

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
							</div><!-- /.blog-main -->
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>