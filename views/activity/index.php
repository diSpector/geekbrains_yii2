<?php
?>

<div class="row">
    <div class="col-md-12">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $provider,
            'tableOptions' => [
                'class' => 'table table-striped table-bordered table-hover',
            ],
            'rowOptions' => function ($model, $key, $index, $grid) {
                $class = $index % 2 ? 'odd' : 'even';
                return [
                    'class' => $class,
                    'index' => $index,
                    'key' => $key,
                ];
            },
            'layout' => "{pager}\n{items}\n{summary}\n{pager}",
            'columns' => [ // вывод определенных столбцов
                ['class' => \yii\grid\SerialColumn::class],
                'id',
                [
                    'attribute' => 'title',
                    'value' => function ($model) {
                        return \yii\helpers\Html::a($model->title, ['/activity/edit', 'id' => $model->id]);
                    },
                    'format' => 'html',
                ],
                [
                    'attribute' => 'dateAct',
                    'label' => 'Дата и время события',
                    'value' => function ($model) {
                        return \Yii::$app->formatter->asDate($model->dateAct) . ' ' . $model->timeStart . ' - ' . $model->timeEnd;
                    }
                ],
                'title:html:Новый заголовок', // название атрибута:формат:значение
                'description',
                [
                    'attribute' => 'user_id',
                    'label' => 'email',
                    'value' => function ($model) {
                        return $model->user->email;
                    }
                ],
                [
                    'attribute' => 'user.email',
                ],
                [
                    'label' => 'Дата создания',
                    'attribute' => 'date_created',
//                    'value' => function($model) { //статическое создание
//                        return $model->getDate();
//                    },
                    'value' => function ($model) { // динамическое создание
                        /** @var $model\app\models\Activity */
                        $model->attachBehavior(
                            'getDate',
                            ['class' => \app\behaviors\GetDateFunctionFormatBehavior::class,
                                'attribute_name' => 'dateAct']);
                        return $model->getDate();
                    },
                ],

            ],
        ]); ?>
    </div>
</div>
