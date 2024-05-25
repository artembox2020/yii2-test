<?php

use app\models\Task;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\widgets\ActiveDropdown;

/** @var yii\web\View $this */
/** @var app\models\TaskSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Задачи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
		'tableOptions' => [
			'class' => 'table table-striped',
		],
		'options' => [
			'class' => 'table-responsive',
		],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
				'attribute' => 'id',
				'filter' => false,
            ],
            [
				'attribute' => 'title',
				'filter' => false,
            ],
            [
				'attribute' => 'description',
				'filter' => false, 
            ],
            [
				'attribute' => 'status',
				'filter' => Task::getStatusList(),
				'filterInputOptions' => ['class' => 'form-control', 'prompt' => 'Все'],
				'format' => 'raw',
				'value' => function ($model) {

					return ActiveDropdown::widget(['model' => $model, 'attribute' => 'status']);
				}
			],
            [
				'attribute' => 'created_at',
				'filter' => false,
			],
            [
                'class' => ActionColumn::className(),
                'header' => 'Действия',
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
