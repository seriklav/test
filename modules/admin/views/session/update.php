<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Session */

$this->title = 'Update Session: ' . $model->session_id;
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->session_id, 'url' => ['view', 'id' => $model->session_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
