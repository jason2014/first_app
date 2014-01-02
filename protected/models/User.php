<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $avatar
 * @property string $salt
 * @property string $email
 * @property string $profile
 * @property string $counts
 * @property string $created
 * @property string $updated
 */
class User extends CActiveRecord
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email', 'unique', 'message'=>'{attribute}已注册！', 'on'=>'register', 'className'=>'User'),//User为Model,username,email在user中不允许重复  
			array('username, nickname, password, email, verifyCode', 'required', 'message'=>'{attribute}不能为空'),
            array('username, password, email', 'length', 'max'=>128),
            array('nickname', 'length', 'max'=>32),
            array('counts, created, updated', 'length', 'max'=>11),
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'验证码不正确！', 'on'=>'register'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			// array('id, username, nickname, password, avatar, salt, email, profile, counts, created, updated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '帐号',
			'nickname' => '昵称',
			'password' => '密码',
			'avatar' => '头像',
			'salt' => '加密',
			'email' => '邮箱',
			'profile' => '描述',
			'counts' => '次数',
			'created' => '创建时间',
			'updated' => '更改时间',
			'verifyCode'=>'验证码',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('counts',$this->counts,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function validatePassword($password){
		return $this->hashPassword($password, $this->salt)==$this->password;
	}

	public function hashPassword($password, $salt){
		return md5($salt.$password);  
	}
}