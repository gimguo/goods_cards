<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $views_count
 */
class Card extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['views_count'], 'integer'],
            [['title'], 'string', 'max' => 250],
            [['image'], 'file', 'extensions' => 'jpg'],
            [['title', 'description'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'views_count' => 'Views Count',
            'image' => 'Picture',
        ];
    }

    public function beforeSave($insert)
    {
        $this->image = UploadedFile::getInstance($this, 'image');
        if ($insert) {
            if (!$this->image) {
                $this->addError('image', 'Выберите картинку');
                return false;
            }
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->image) {
            if ($insert) {
                $id = Yii::$app->db->getLastInsertID();
                $this->image->saveAs("uploads/card_img/{$id}.{$this->image->extension}");
            } else {
                $this->image->saveAs("uploads/card_img/{$this->id}.{$this->image->extension}");
            }
        }

        $model = ElasticCard::get($this->id);
        if (!$model) {
            $model = new ElasticCard();
        }
        $model->id = $this->id;
        $model->title = $this->title;
        $model->description = $this->description;
        $model->views_count = $this->views_count;
        $model->save();

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        FileHelper::unlink("uploads/card_img/{$this->id}.jpg");

        $model = ElasticCard::get($this->id);
        if ($model) {
            $model->delete();
        }

        parent::afterDelete();
    }
}
