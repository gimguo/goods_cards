<?php

namespace common\models;

use yii\elasticsearch\ActiveQuery;

/**
 * ElasticCardQuery
 */
class ElasticCardQuery extends ActiveQuery
{
    public function settings()
    {
        $this->limit(6);
        $this->orderBy("id DESC");
        return $this;
    }
}
