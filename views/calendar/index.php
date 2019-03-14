<?php
use \yii\helpers\Html;
?>

<h3><?= Html::a('Назад к списку активностей', '/activity/all'); ?></h3>
<h3><?= Html::a('Назад в аккаунт', '/account/index'); ?></h3>
<h3>Календарь</h3>
<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
    'events'=> $events,
));?>

