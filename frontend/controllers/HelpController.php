<?php

namespace frontend\controllers;

use yii\web\Controller;


class HelpController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionAccountSetting()
    {
        return $this->render('AccountSetting');
    }

    public function actionLoginAndSecurity(){
        return $this->render('LoginAndSecurity');
    }

    public function actionPrivacy(){
        return $this->render('privacy');
    }
}
