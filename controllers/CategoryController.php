<?php


namespace app\controllers;

use app\modules\admin\models\Article;
use app\modules\admin\models\Category;
use yii\data\Pagination;
use Yii;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
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
		$model = $this->findModel($id);

		$this->setMeta([
			'title' => $model->name,
			'description' => $model->name
		]);

		$query = Article::find()->where(['category_id' => $id]);

		$pages = new Pagination([
			'totalCount' => $query->count(),
			'pageSize' => 6,
			'forcePageParam' => false,
			'pageSizeParam' => false
		]);

		$articles = $query->offset($pages->offset)->limit($pages->limit)->all();

		return $this->render('view', [
			'model' => $model,
			'articles' => $articles,
			'pages' => $pages
		]);
	}

	/**
	 * Finds the Category model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Category the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Category::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('Такой категории нет!');
	}
}