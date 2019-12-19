<?php


namespace app\modules\admin\controllers;


use app\models\User;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;

class AppAdminController extends Controller
{
	public function __construct($id, $module, $config = [])
	{
		parent::__construct($id, $module, $config);
		if (!\Yii::$app->user->isGuest) {
			if (\Yii::$app->user->identity->role == User::ROLE_USER) {
				$this->redirect('/user');
			}
		} else {
			return $this->goHome();
		}
	}

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