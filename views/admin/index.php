<?php
use \yii\helpers\Html;
?>
<div class="row">
    <h2>Административная панель</h2>
    <div class="col-md-2">
        <?= Html::a('Просмотр событий', ['admin/activities'], ['class' => 'btn btn-primary']) ?><br>
    </div>
    <div class="col-md-2">
        <?= Html::a('Просмотр пользователей', ['admin/users'], ['class' => 'btn btn-success']) ?>

    </div>

</div>

