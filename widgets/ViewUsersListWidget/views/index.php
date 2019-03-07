<?php
?>

<div class="col-md-6">
        <pre>
            <?php foreach ($users as $user) :?>
            <?= \yii\helpers\VarDumper::dump($user);?>
            <?php endforeach;?>
        </pre>
</div>
