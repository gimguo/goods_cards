<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Card */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cards', 'url' => ['card']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'views_count',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    $link = Yii::$app->urlManagerBackend->baseUrl . '/uploads/card_img/' . $data['id'] . '.jpg';
                    return Html::img($link, ['width' => '600px']);
                },
            ],
        ],
    ]) ?>

</div>
