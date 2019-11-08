<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchBook */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'label' => 'Автор',
                'value' => function($model) {
                    return join(', ', yii\helpers\ArrayHelper::map($model->authors, 'id', 'surname'));
                },
            ],
            [
                'attribute'=>'content',
                'label'=>'Описание',
                'options' => ['style' => 'width: 45%; max-width: 45%;'],
                'contentOptions'=>['style'=>'white-space: normal;']
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Действия' ],
        ],
    ]); ?>


</div>
