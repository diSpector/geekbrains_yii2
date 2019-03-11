<?php

use \yii\helpers\Html;

?>
<div class="row">
    <h2>Все события</h2><br>
    <div class="col-md-12">
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

//                'id',
                [
                    'attribute' => 'title',
                    'label' => 'Название события',
                ],
                [
                    'attribute' => 'dateAct',
                    'label' => 'Назначенное время',
                    'value' => function ($model) {
                        return \Yii::$app->formatter->asDate($model->dateAct) . ' ' . $model->timeStart . ' - ' . $model->timeEnd;
                    }
                ],
                [
                    'attribute' => 'date_created',
                    'label' => 'Дата и время создания',
                ],
                [
                    'attribute' => 'date_updated',
                    'label' => 'Дата и время обновления',
                ],
                [
                    'attribute' => 'user.email',
                    'label' => 'Email пользователя'
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действие',
                    'template' => '{update} | {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('Редактировать', ['activity/edit', 'id' => $key]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Удалить', ['activity/delete', 'id' => $key],[
                                'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить событие?'),
                                'data-method' => 'post',
                            ]);
                        },
                    ],

                ],
//                [
//                    'attribute' => 'title',
//                    'value' => function ($model) {
//                        return \yii\helpers\Html::a($model->title, ['/activity/edit', 'id' => $model->id]);
//                    },
//                    'format' => 'html',
//                ],
//                [
//                    'attribute' => 'dateAct',
//                    'label' => 'Дата и время события',
//                    'value' => function ($model) {
//                        return \Yii::$app->formatter->asDate($model->dateAct) . ' ' . $model->timeStart . ' - ' . $model->timeEnd;
//                    }
//                ],
//                'title:html:Новый заголовок', // название атрибута:формат:значение
//                'description',
//                [
//                    'attribute' => 'user_id',
//                    'label' => 'email',
//                    'value' => function ($model) {
//                        return $model->user->email;
//                    }
//                ],
//                [
//                    'attribute' => 'user.email',
//                ],
//                [
//                    'label' => 'Дата создания',
//                    'attribute' => 'date_created',
////                    'value' => function($model) { //статическое создание
////                        return $model->getDate();
////                    },
//                    'value' => function ($model) { // динамическое создание
//                        /** @var $model\app\models\Activity */
//                        $model->attachBehavior(
//                            'getDate',
//                            ['class' => \app\behaviors\GetDateFunctionFormatBehavior::class,
//                                'attribute_name' => 'dateAct']);
//                        return $model->getDate();
//                    },
//                ],

            ],
        ]); ?>
        <br>
        <?= Html::a('Вернуться', ['/admin/index'], ['class' => 'btn btn-success']) ?>
    </div>
</div>
