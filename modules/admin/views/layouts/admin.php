<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
		if (!Yii::$app->user->isGuest) {
			NavBar::begin([
				'brandLabel' => Yii::$app->name,
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [
					'class' => 'navbar-inverse navbar-fixed-top',
				],
			]);

			if (Yii::$app->user->identity->role == User::ROLE_ADMINISTRATOR) {
				$menuItems = [
					['label' => 'Главная', 'url' => ['/admin']],
					['label' => 'Категории', 'url' => ['/admin/category']],
					['label' => 'Статьи', 'url' => ['/admin/article']],
					['label' => 'Пользователи', 'url' => ['/admin/user']],
					['label' => 'Тесты', 'url' => ['/admin/test']],
					['label' => 'Ответы-Вопросы', 'url' => ['/admin/answer']],
				];
			} elseif (Yii::$app->user->identity->role == User::ROLE_USER) {

			}

			$menuItems[] = '<li class="logout-main">'
				. Html::beginForm(['/site/logout'], 'post')
				. Html::submitButton(
					'Logout (' . Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name . ')',
					['class' => 'btn btn-link logout']
				)
				. Html::endForm()
				. '</li>';

			echo Nav::widget([
				'options' => ['class' => 'navbar-nav navbar-right'],
				'items' => $menuItems,
			]);

			NavBar::end();
		}
	?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Aleco-Test <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
