<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Task;

$form = ActiveForm::begin([
	'options' => [
		'name' => $name,
    ],
    'enableAjaxValidation' => true,
]);

echo Html::hiddenInput("{$name}[id]", $model->id);
echo $form->field($model, $attribute, ['template' => "{input}\n{error}"])->dropDownList(Task::getStatusList());

ActiveForm::end();

?>
