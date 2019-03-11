<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $token
 * @property string $fio
 * @property int $role_id
 * @property string $date_created
 *
 * @property Activity[] $activities
 * @property AuthorizeUsers[] $authorizeUsers
 * @property UserRoles $role
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash'], 'required'],
            [['role_id'], 'integer'],
            [['date_created'], 'safe'],
            [['email', 'token', 'fio'], 'string', 'max' => 150],
            [['password_hash'], 'string', 'max' => 300],
//            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'fio' => Yii::t('app', 'Fio'),
            'role_id' => Yii::t('app', 'Role ID'),
            'date_created' => Yii::t('app', 'Date Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorizeUsers()
    {
        return $this->hasMany(AuthorizeUsers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(UserRoles::className(), ['id' => 'role_id']);
    }
}
