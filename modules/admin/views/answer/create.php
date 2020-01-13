<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Answer */
/* @var $model app\modules\admin\models\Answer */

$this->title = 'Створити запитання';
$this->params['breadcrumbs'][] = ['label' => 'Запитання та відповіді', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
