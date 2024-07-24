<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;

/** @var yii\web\View $this */
/** @var common\models\Testimonial $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $projects  */
?>

<div class="testimonial-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->dropDownList($projects, ['prompt' => Yii::t('app', 'select a project')]) ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview' => $model->imageAbsolteUrl(), // Corrected 'initialPreview'
            'initialPreviewAsData' => true,
            'initialPreviewConfig' => $model->imageConfig(), // Corrected 'initialPreviewConfig'
            'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
            'showUpload' => false,
            'deleteUrl' => Url::to(['testimonial/delete-customer-image'])
        ],
    ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'review')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rating')->widget(StarRating::class, [
        'pluginOptions' => ['step' => 1]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>