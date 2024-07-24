<?php

use yii\helpers\Html;

$this->title = 'Help Center';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="help-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec justo ex. Phasellus lobortis nibh leo, a
        sollicitudin magna elementum vitae. In aliquet augue ac lobortis dignissim. Nam bibendum accumsan arcu a tempor.
        Nullam in tincidunt velit. Proin scelerisque suscipit erat, in porttitor mi pretium eu. Aliquam erat volutpat.
        Nunc accumsan lobortis massa, nec finibus orci vestibulum in. Donec dictum a neque at interdum.
    </p>

    <!-- <?= Html::a('Visit Google', 'https://www.google.com') ?> -->
    <!-- <?= Html::a('Styled Link', ['site/index'], ['class' => 'btn btn-success']) ?> -->
    <!-- <?= Html::a('Open in New Tab', ['site/index'], ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?> -->
    <!-- <?= Html::a('Profile', ['user/view', 'id' => 42]) ?> -->
    <!-- <?= Html::a('View Profile', ['help/login-and-security', 'id' => 'no'], ['class' => 'profile-link', 'title' => 'sfu segufgsdgfuhgsduhfguhsdg fg sdug sdfguvbu vbuyg ']) ?> -->

    <div>
        <?= Html::a('Account Setting', ['help/account-setting']) ?>
     </div>
    <div>
        <?= Html::a('Login And Security', ['help/login-and-security']) ?>
    </div>
    <div>
        <?= Html::a('Privacy', ['help/privacy']) ?>
    </div>
</div>