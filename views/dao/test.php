<?php
use app\widgets\ViewUsersListWidget\ViewUsersListWidget;
?>

<div class="row">
    <?= ViewUsersListWidget::widget(['users' => $users]) ?>
    <div class="col-md-6">
        <pre>
            <?php print_r($activityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php print_r($firstActivity);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php print_r($count_notif);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php print_r($allActivityUser);?>
        </pre>
    </div>
    <div class="col-md-6">
        <pre>
            <?php foreach($activityReader as $item): ?>
            <?= print_r($item); ?><br>
            <?php endforeach; ?>
        </pre>
    </div>


</div>
