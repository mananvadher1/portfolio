<?php

use yii\helpers\Html;
use yii\bootstrap5\Carousel;

/** @var yii\web\View $this */
/** @var common\models\Project $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="project-view__details">
        <?= $model->start_date . ' ' . Yii::t('app', 'to') . ' ' . $model->end_date ?>
    </div>

    <?= Carousel::widget([
        'items' => $model->carouselImages(),
        'options' => ['class' => 'project-view__carousel'],
    ]); ?>


    <div class="project-view__tech-stack">
        <span class="font-weight-bold"><?= Yii::t('app', 'Tech stack') ?>: </span>
        <?= $model->tech_stack ?>
    </div>

    <div class="project-view__description">
        <?= $model->description ?>
    </div>

    <div><?= Yii::t('app', 'Testimonials') ?></div>
</div>