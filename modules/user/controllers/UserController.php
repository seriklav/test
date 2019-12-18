<?php

namespace app\modules\user\controllers;

use app\modules\user\models\HistorySearch;
use Yii;

class UserController extends AppUserController
{
    public function actionIndex()
    {
	    $searchModel = new HistorySearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

	    return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	    ]);
    }

}
