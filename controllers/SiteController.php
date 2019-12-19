<?php

namespace app\controllers;

use app\modules\admin\models\Article;
use Yii;
use yii\web\Response;
use app\models\LoginForm;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionIndex()
	{
		if (Yii::$app->user->isGuest) {
			$model = new LoginForm();

			$model->password = '';

			return $this->render('login', [
				'model' => $model,
			]);
		} else {
			$articles = Article::find()->limit(6)->orderBy(['created_at' => SORT_DESC])->asArray()->all();

			return $this->render('index', [
				'articles' => $articles
			]);
		}
	}

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
	        return $this->goHome();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
