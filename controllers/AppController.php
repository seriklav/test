<?php


namespace app\controllers;


use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 *
 * @property array $meta
 */
class AppController extends Controller
{
	protected function setMeta($data = [])
	{
		$this->view->title = $data['title'] ?? '';
		$this->view->registerMetaTag(['name' => 'keywords', 'content' => $data['keywords'] ?? '']);
		$this->view->registerMetaTag(['name' => 'description', 'content' => $data['description'] ?? '']);
	}
}