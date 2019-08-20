<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cards';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            'id',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    $link = Yii::$app->urlManagerBackend->baseUrl . '/uploads/card_img/' . $data['id'] . '.jpg';
                    return Html::img($link, ['width' => '70px']);
                },
            ],
            'title',
            'description:ntext',
            'views_count',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $customurl = Yii::$app->getUrlManager()->createUrl(['site/card-view', 'id' => $model['id']]); //$model->id для AR
                        return \yii\helpers\Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $customurl,
                            ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
