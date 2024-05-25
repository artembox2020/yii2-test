<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            ['status', 'in', 'range' => array_keys(self::getStatusList())],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at',
				'value' => new Expression('NOW()'),
			],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public static function getStatusList()
    {
		return [
			1 => 'pending',
			2 => 'in progress',
			3 => 'completed',
		];
	}
}
