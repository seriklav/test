<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $name
 * @property string|null $description
 * @property string $keywords
 *
 * @property Article[] $articles
 */
class Category extends \yii\db\ActiveRecord
{
	public $tree = [];

	/**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return 'category';
	}

	public function afterSave($insert, $changedAttributes){
		parent::afterSave($insert, $changedAttributes);
		Yii::$app->cache->set('menu', '');
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			[['parent_id'], 'integer'],
			[['name'], 'required'],
			[['description'], 'string'],
			[['name'], 'string', 'max' => 255],
			[['keywords'], 'string'],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id' => '№ Категории',
			'parent_id' => 'Родительская категория',
			'name' => 'Имя',
			'description' => 'Описание',
			'keywords' => 'Ключевые слова',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'parent_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getArticles()
	{
		return $this->hasMany(Article::className(), ['category_id' => 'id']);
	}

	public function getTree()
	{
		$data = $this->find()->indexBy('id')->asArray()->all();

		$tree = [];
		foreach ($data as $id => &$node) {
			if (!$node['parent_id'])
				$tree[$id] = &$node;
			else
				$data[$node['parent_id']]['childs'][$node['id']] = &$node;
		}
		$this->getOption($tree);
	}

	public function getOption($tree, $name = '')
	{
		foreach ($tree as $item) {
			if ($name) {
				$this->tree[$item['id']] = $name . ' > ' . $item['name'];
			} else {
				$this->tree[$item['id']] = $item['name'];
			}

			if (!empty($item['childs'])) {
				$this->getOption($item['childs'], $this->tree[$item['id']]);
			}
		}
	}
}
