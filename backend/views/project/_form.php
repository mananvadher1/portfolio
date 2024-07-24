<?php

use yii\helpers\Url;

use yii\helpers\Html;
use kartik\file\FileInput;
use kartik\editors\Summernote;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile(
    '@web/js/projectForm.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

<div class="project-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div class=\"form-group label-floating\">{label}{input}{error}</div>",
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'tech_stack')->widget(Summernote::class, [
        'useKrajeePresets' => true,
        // other widget settings
    ]); ?>

    <?php echo $form->field($model, 'description')->widget(Summernote::class, [
        'useKrajeePresets' => true,
        // other widget settings
    ]); ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::class, [
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['readonly'],
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::class, [
        // 'dateFormat' => 'yyyy-MM-dd',
        'options' => ['readonly'],
    ]) ?>
    <!-- <pre>
    <?php
        $man = [];
        $man = $model->imageAbsoluteUrls();
        print_r($man);
    ?>
    </pre> -->
    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::class, [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'pluginOptions' => [
            'initialPreview' => $model->imageAbsoluteUrls(),
            'initialPreviewAsData' => true,
            'showUpload' => false,
            'deleteUrl' => Url::to(['project/delete-project-image']),
            'initialPreviewConfig' => $model->imageConfigs(),
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>