<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model ruslan89\seo\models\SeoPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meta-tags-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'header')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'subheader')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'title')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'keywords')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'seo_text')->widget(CKEditor::className(), [
        'preset' => 'full',
        'options' => ['rows' => 6],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
