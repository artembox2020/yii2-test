<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use app\models\Task;

/**
 * ActiveDropdown отображает в виде выпадающего списка
 * и динамически обновляет аяксом необходимый атрибут модели ActiveRecord
 * 
 * @param ActiveRecord $model
 * @param string $attribute
 * @author Artem Palamarchuk <artembo2020@gmail.com>
 */
class ActiveDropdown extends Widget {

	public $model;
	public $attribute;

	const NAME = 'ActiveDropdown';

    /** 
	 * Перехватчик аякс-запроса, если запрос от него самого,
	 * то обрабатывает его и возвращает масив с результатом,
	 * иначе возвращает false
	 * 
	 * @param ActiveRecord $model
	 * @param mixed $attribute
	 * @return array|false
	 */ 
	public static function ajaxProcess($model, $attribute)
	{
		if(Yii::$app->request->isAjax) {

			$post = Yii::$app->request->post();

			if (empty($id = self::getActiveModelIdFromPost($post))) {

				return false;
			}

			$name = (new \ReflectionClass($model))->getShortName();

			if (!empty($post[$name][$attribute])) {
				$model = $model::findOne($id);
				$model->$attribute = $post[$name][$attribute];
				$result = $model->save();
			} else {
				$result = false;
			}

			return ['result' => $result];
		}

		return false;
	}

	/**
	 * Возвращает ID модели ActiveRecord из массива $_POST
	 * или false, если запрос не от ActiveDropdown
	 * 
	 * @param array $post
	 * @return integer|false
	 */ 
	public static function getActiveModelIdFromPost($post)
	{
		if (!array_key_exists(self::NAME, $post)) {

			return false;
		}

		if (!array_key_exists('id', $post[self::NAME])) {

			return false;
		}

		return $post[self::NAME]['id'];
	}

	/**
     * @inheritDoc
     */
	public function run()
    {
		$model = $this->model;
		$attribute = $this->attribute;
		$name = self::NAME;

        return $this->render('active_dropdown', compact('model', 'attribute', 'name'));
    }
}
