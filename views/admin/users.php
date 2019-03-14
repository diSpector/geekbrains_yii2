<?php

use \yii\helpers\Html;

?>
<h2>Зарегистрированные пользователи</h2><br>
<div class="row">
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
                    'attribute' => 'email',
                    'label' => 'Email пользователя',
                ],
                [
                    'attribute' => 'fio',
                    'label' => 'ФИО пользователя',
                ],
                [
                    'attribute' => 'date_created',
                    'label' => 'Дата и время создания',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действие',
                    'template' => '{update} | {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('Редактировать', ["admin/user-edit/$key"]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Удалить', ['admin/user-delete', 'id' => $key],[
                                'data-confirm' => Yii::t('yii', 'Вы уверены, что хотите удалить пользователя?'),
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
        <?= Html::a('Создать нового пользователя', ['/admin/new-user'], ['class' => 'btn btn-primary']) ?>
        <br>        <br>

        <?= Html::a('Вернуться', ['/admin/index'], ['class' => 'btn btn-success']) ?>

    </div>
</div>
