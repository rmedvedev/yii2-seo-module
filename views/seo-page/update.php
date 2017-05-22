<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ruslan89\seo\models\SeoPage */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Seo Page',
    ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="meta-tags-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
