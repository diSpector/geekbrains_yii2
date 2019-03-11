<?php
/**
 * Created by PhpStorm.
 * User: Ирина
 * Date: 09.03.2019
 * Time: 0:19
 * @var \app\models\Activity $model
 */

?>

<h2>Событие стартует сегодня</h2>
<strong><?=$model->title?></strong>
<p style="color: green;">Дата старта: <?=\Yii::$app->formatter->asDatetime($model->timeStart) ?></p>