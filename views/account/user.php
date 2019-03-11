<?php

use \yii\helpers\Html;

?>

<div class="row">
    <div class="col-lg-6">
        <h2>Мои данные:</h2>
        <h3>Email: <?= $user->email; ?></h3>
        <h3>ФИО: <?= $user->fio; ?></h3>
        <br>
        <?= Html::a('Изменить', '/account/user-edit', ['class' => 'btn btn-primary']); ?><br><br>
        <?= Html::a('Назад', '/account/index', ['class' => 'btn btn-info']); ?><br>
    </div>


</div>
