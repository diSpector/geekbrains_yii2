<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $dateAct
 * @property string $timeStart
 * @property string $timeEnd
 * @property int $use_notification
 * @property string $description
 * @property int $is_blocked
 * @property int $is_repeated
 * @property int $user_id
 * @property int $is_completed
 * @property string $date_updated
 * @property string $date_created
 *
 * @property Users $user
 * @property Images[] $images
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'timeStart', 'description', 'user_id'], 'required'],
            [['dateAct', 'date_created'], 'safe'],
            [['use_notification', 'is_blocked', 'is_repeated', 'user_id', 'is_completed'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 150],
            [['timeStart', 'timeEnd'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'dateAct' => Yii::t('app', 'Date Act'),
            'timeStart' => Yii::t('app', 'Time Start'),
            'timeEnd' => Yii::t('app', 'Time End'),
            'use_notification' => Yii::t('app', 'Use Notification'),
            'description' => Yii::t('app', 'Description'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'is_repeated' => Yii::t('app', 'Is Repeated'),
            'user_id' => Yii::t('app', 'User ID'),
            'is_completed' => Yii::t('app', 'Is Completed'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

//    public function getUserID()
//    {
//        return $this->getUser()['id'];
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getImages()
//    {
//        return $this->hasMany(Images::className(), ['activity_id' => 'id']);
//    }

}
