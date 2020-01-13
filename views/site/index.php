<?php

/* @var $articles array */

use app\components\MenuWidget;
use yii\helpers\Url; ?>

<section>
	<div class="container">
		<div class="jumbotron">
			<h1>Ласкаво просимо!</h1>

			<p class="lead">Виберіть категорію і статтю для навчання.</p>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<div class="box">
					<h2>Категорія</h2>

					<ul class="catalog category-products">
						<?= MenuWidget::widget(['tpl' => 'menu']); ?>
					</ul>

				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="body-content">

					<div class="box">
						<h2>Останні статті</h2>
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
					</div>

				</div>
			</div>
		</div>
	</div>
</section>