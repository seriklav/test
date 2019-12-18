<?php

/* @var $model app\modules\admin\models\Category */
/* @var $articles array */
/* @var $pages int */

use app\components\MenuWidget;
use yii\helpers\Url;
use yii\widgets\LinkPager; ?>

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
						<h2>Категория "<?= $model->name ?>"</h2>
						<?php if ($articles): ?>
							<?php foreach (array_chunk($articles, 3) as $article_row): ?>
								<div class="row">
									<?php foreach ($article_row as $article): ?>
										<div class="col-lg-4">
											<h2><?= $article['name'] ?></h2>

											<p><?= mb_strimwidth(strip_tags($article['description']), 0, 250, "...") ?></p>

											<p><a class="btn btn-default" href="<?= Url::to(['article/view', 'id' => $article['id']]) ?>">Перейти</a></p>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endforeach; ?>

							<?php
								echo LinkPager::widget([
									'pagination' => $pages,
								]);
							?>
						<?php else: ?>
							<div class="alert alert-warning">В этой категори нет материала для обучения.</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>