<?php

namespace common\models;

use yii\elasticsearch\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $views_count
 */
class ElasticCard extends ActiveRecord
{
    public static function primaryKey()
    {
        return ['id'];
    }

    public function attributes()
    {
        return ['id', 'title', 'description', 'views_count'];
    }

    /**
     * @inheritdoc
     * @return ElasticCardQuery
     */
    public static function find()
    {
        return new ElasticCardQuery(get_called_class());
    }
}
