<?php
?>

<?php if (empty($activities)): ?>
    <p>Событий нет</p>
<?php else: ?>
    <?php foreach ($activities as $activity): ?>
        <strong>Название события: <?= $activity->title; ?></strong>
        <p>Дата и время
            события: <?= date('d-m-Y', strtotime($activity->dateAct)) . ', ' . $activity->timeStart . ' - ' . $activity->timeEnd; ?></p>
        <p>Описание события: <?= $activity->description; ?></p><br>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>