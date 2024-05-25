<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * Gallery отображает галерею изображений как в "поиске гугл раздел картинки"
 * 
 * @author Artem Palamarchuk <artembo2020@gmail.com>
 */
class Gallery extends Widget {

	/**
     * @inheritDoc
     */
	public function run()
    {

        return $this->render('gallery');
    }
}
