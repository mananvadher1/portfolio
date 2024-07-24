<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */

$this->title = Yii::$app->name . '- My Portfolio';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <?= Html::img('@web/images/photo.jpeg', [
                'alt' => Yii::t('app', 'My Profile Photo'),
                'class' => 'site-index__photo',
            ]) ?>

            <h1 class="site-index__h1">Hello, my name is Manan!</h1>
            <p class="fs-5 fw-light">passionate developing Yii2 websites and web application</p>
            <p>
                <?= Html::a(Yii::t('app', 'See my work'), ['/project'], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>
</div>