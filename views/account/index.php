<?php
use \yii\helpers\Html;
?>

<div class="row">
    <h2>Аккаунт</h2>
    <h3><?= Html::a('Личные данные', '/account/user'); ?></h3>
    <h3><?= Html::a('Активности', '/activity/all'); ?></h3>
    <h3><?= Html::a('Календарь', '/calendar/index'); ?></h3>

</div>
