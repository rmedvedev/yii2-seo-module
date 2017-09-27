<?php

use himiklab\sortablegrid\SortableGridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seo Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-tags-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Create Seo Page'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name:text',
            'code:text',
            'route:text',
            'title:ntext',
            'description:ntext',
            'keywords:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'options' => [
                    'width' => '70px',
                ],
            ],
        ],
    ]); ?>
</div>
