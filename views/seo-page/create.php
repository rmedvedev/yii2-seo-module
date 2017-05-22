<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ruslan89\seo\models\SeoPage */

$this->title = Yii::t('app', 'Create Seo Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-tags-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
