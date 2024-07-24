<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Project $model */
/** @var backend\models\TestimonialSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \common\models\Project[] $projects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->can('manageProjects')) : ?>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
        <p>
            <?= Html::a(Yii::t('app', 'New Testimonial'), ['testimonial/create', 'project_id' => $model->id]) ?>
        </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label' => Yii::t('app', 'Images'),
                'format' => 'raw',
                'value' => function ($model) {
                    /**
                     * @var $model \common\models\project
                     */
                    if (!$model->hasImages()) {
                        return null;
                    }
                    // else {
                    //     return Html::img($model->(), ['width' => 100]);
                    // }
                    $imagesHtml = "";
                    foreach ($model->projectImages as $image) {
                        $imagesHtml .= Html::img($image->file->absoluteUrl(), [
                            'alt' => 'Demonstration of the user interface',
                            'height' => 200,
                            'width' => 300,
                            'class' => 'project-view_img',
                        ]);
                    }
                    return $imagesHtml;
                },
            ],
            'tech_stack:raw',
            'description:raw',
            'start_date',
            'end_date',
            // [
            //     'label' => Yii::t('app', 'Testimonials'),
            //     'format' => 'raw',
            //     'value' => function ($model) {
            //         /**
            //          * @var $model \common\models\project
            //          */
            //         if (!$model->testimonials) {
            //             return null;
            //         }
            //         $html = "";
            //         foreach ($model->testimonials as $testimonial) {
            //             $label = $testimonial->title . ' | ' . $testimonial->customer_name . ' | ' . $testimonial->rating;
            //             $html .= Html::a($label, ['testimonial/view', 'id' => $testimonial->id]);
            //         }
            //         return $html;
            //     },
            // ]
        ],
    ]) ?>

    <h1><?= Yii::t('app', 'Testimonials') ?></h1>

    <!-- <?= $this->render('/testimonial/_gridView', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'projects' => $projects,
                'isProjectColumnVisible' => false,
            ]); ?> -->

    <?php foreach ($model->testimonials as $testimonial) : ?>
        <div><?= Html::a($testimonial->title, ['testimonial/view', 'id' => $testimonial->id]) ?></div>
    <?php endforeach; ?>

</div>