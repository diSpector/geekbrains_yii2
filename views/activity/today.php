<?php
use \yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-12">
        <h4><?= Html::a('Показать все события', ['/activity/all']) ?>  |
            <?= Html::a('Показать события на сегодня', ['/activity/today']) ?></h4>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider,
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-hover',
            ],
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [ // вывод определенных столбцов
                [ // порядковый номер
                    'class' => \yii\grid\SerialColumn::class,
                    'header' => 'Номер', // заголовок столбца
                ],
                [
                    'attribute' => 'title',
                    'label' => 'Название активности',
                ],
                [
                    'attribute' => 'dateAct',
                    'label' => 'Назначенное время',
                    'value' => function ($model) {
                        return \Yii::$app->formatter->asDate($model->dateAct) . ', ' . $model->timeStart . ' - ' . $model->timeEnd;
                    }
                ],
                [
                    'attribute' => 'date_created',
                    'label' => 'Дата и время создания',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действие',
                    'template' => '{view} | {update} | {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('Просмотр', ['activity/view', 'id' => $key]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('Редактировать', ['activity/edit', 'id' => $key]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Удалить', ['activity/delete', 'id' => $key], [
                                'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить событие?'),
                                'data-method' => 'post',
                            ]);
                        },
                    ],

                ],
            ],
        ]); ?>
    </div>
    <?= Html::a('Создать новую активность', ['/activity/create'], ['class' => 'btn btn-primary']) ?>
    <br>

    <br>
    <?= Html::a('Вернуться', ['/account/index'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
