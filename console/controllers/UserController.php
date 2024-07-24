<?php

namespace console\controllers;

use Yii;
use common\models\User;
use yii\console\Controller;

class UserController extends Controller
{
    /**
     * This command registers a new user.
     * @param string $username the username
     * @param string $email the email
     * @param string $password the password
     */
    public function actionRegister($username, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        
        if ($user->save()) {
            echo "User registered successfully.\n";
        } else {
            echo "Failed to register user.\n";
            print_r($user->getErrors());
        }
    }
}
