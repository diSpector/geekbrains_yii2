<?php

use yii\Helpers\Html;

?>

<div class="row">
    <p>Создано событие:</p>
    <ul>
        <li><label>Дата</label>: <?= Html::encode($activity->dateAct); ?></li>
        <li><label>Время</label>: <?= Html::encode($activity->timeStart) . ' - ' . Html::encode($activity->timeEnd); ?>
        </li>
        <li><label>Название</label>: <?= Html::encode($activity->title); ?></li>
        <li><label>Описание</label>: <?= Html::encode($activity->description); ?></li>
        <li><label>Уведомление</label>: <?= Html::encode($activity->use_notification) ? 'Да' : 'Нет'; ?></li>
        <li><label>Блокирующее</label>: <?= Html::encode($activity->is_blocked) ? 'Да' : 'Нет'; ?></li>
        <li><label>Повторяющееся</label>: <?= Html::encode($activity->is_repeated) ? 'Да' : 'Нет'; ?></li>
        <li><label>Загруженные файлы:</label></li>
        <div class="row">
            <?php if (empty($activity->imagesNewNames)) {
                echo 'Нет';
            } else {
                foreach ($activity->imagesNewNames as $image) {
                    echo Html::img('/images/' . $image, ['class' => 'col-lg-3']);
                }
            }
            ?>
        </div>
        <li><label>ID вставленной записи</label>: <?= Html::encode($id); ?></li>
    </ul>
    <?= Html::a('Создать новое событие', ['/activity/create'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Редактировать', ["/activity/edit/$id"], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Календарь', ['/calendar/view'], ['class' => 'btn btn-primary']) ?>

</div>