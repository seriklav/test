<?php


namespace app\controllers;

use app\models\User;
use app\modules\admin\models\Answer;
use app\modules\admin\models\History;
use app\modules\admin\models\Test;
use Yii;
use yii\web\NotFoundHttpException;

class TestController extends AppController
{
	public function beforeAction($action)
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect('/site/login');
		}
		if (!parent::beforeAction($action)) {
			return false;
		}
		return true;
	}

	public function actionView($id)
	{
		$balls = 0;

		if (Yii::$app->request->post()) {
			$answers = Yii::$app->request->post();
			array_shift($answers);

			foreach ($answers as $answer_id => $answer) {
				$answer_id = (int)str_replace('answer_', '', $answer_id);
				$answer_info = Answer::find()->where(['id' => $answer_id])->one();

				if ($answer_info) {
					if ($answer == $answer_info->correct) {
						$balls += $answer_info->balls;
					}
				}
			}

			if ($balls) {
				$history = new History();
				$history->test_id = $id;
				$history->user_id = Yii::$app->user->identity->getId();
				$history->balls = $balls;

				$history->save();

				$user = \app\modules\admin\models\User::findOne(Yii::$app->user->identity->getId());
				$user->rating += $balls;
				$user->save();

				Yii::$app->session->setFlash('success', 'Вы набрали: ' . $balls . ' бал(ов)');
			}
		}

		$model = $this->findModel($id);

		$hide = false;

		if (History::find()->where(['test_id' => $id])->andWhere(['user_id' => Yii::$app->user->identity->getId()])->one()) {
			$hide = true;
		}

		$model->created_at = $this->formatDate($model->created_at);

		$this->setMeta([
			'title' => 'Тест ' . $model->name,
			'description' => 'Тест ' . mb_strimwidth(strip_tags($model->description), 0, 250, "..."),
		]);

		return $this->render('view', [
			'model' => $model,
			'hide' => $hide
		]);
	}

	/**
	 * Finds the Test model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Test the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Test::findOne($id)) !== null) {
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