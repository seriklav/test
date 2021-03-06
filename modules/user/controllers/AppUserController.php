<?php


namespace app\modules\user\controllers;


use app\models\User;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 *
 * @property array $meta
 */
class AppUserController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@']
					]
				]
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
		];
	}

	protected function setMeta($data = [])
	{
		$this->view->title = $data['title'] ?? '';
		$this->view->registerMetaTag(['name' => 'keywords', 'content' => $data['keywords'] ?? '']);
		$this->view->registerMetaTag(['name' => 'description', 'content' => $data['description'] ?? '']);
	}
}