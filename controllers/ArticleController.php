<?php


namespace app\controllers;

use app\modules\admin\models\Article;
use yii\web\NotFoundHttpException;

class ArticleController extends AppController
{
	public function actionView($id)
	{
		$model = $this->findModel($id);

		$model->created_at = $this->formatDate($model->created_at);

		$this->setMeta([
			'title' => $model->name,
			'description' => $model->name
		]);

		return $this->render('view', [
			'model' => $model
		]);
	}

	/**
	 * Finds the Article model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Article the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Article::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('The requested page does not exist.');
	}

	/**
	 * @param $date
	 * @return string|string[]
	 */
	protected function formatDate($date) {
		$currentDate = date("d.m.Y", strtotime($date));

		$_monthsList = array(
			".01." => "января",
			".02." => "февраля",
			".03." => "марта",
			".04." => "апреля",
			".05." => "мая",
			".06." => "июня",
			".07." => "июля",
			".08." => "августа",
			".09." => "сентября",
			".10." => "октября",
			".11." => "ноября",
			".12." => "декабря"
		);

		$_mD = date(".m.", strtotime($date)); //для замены
		return str_replace($_mD, " ".$_monthsList[$_mD]." ", $currentDate);
	}
}