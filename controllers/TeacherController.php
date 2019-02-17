<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 17.02.2019
 * Time: 5:36
 */

namespace app\controllers;


use yii\web\Controller;

class TeacherController extends Controller
{
    public function actionStudent(){
        return $this->render('student');
    }
}