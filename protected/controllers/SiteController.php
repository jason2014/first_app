<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF, //背景颜色
				'minLength'=>4,  //最短为4位
				'maxLength'=>4, //最长为4位
				'transparent'=>true,  //显示为透明，当关闭该选项，才显示背景颜色
				'testLimit'=>999,    //这里可以设置大一些,以免验证超过三次会出错.
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$year = Yii::app()->request->getParam('year');
		$month = Yii::app()->request->getParam('month');
		$tag = Yii::app()->request->getParam('tag');
		$category = Yii::app()->request->getParam('category');

		$criteria = new CDbCriteria();
		if(isset($tag)){
			$criteria->addSearchCondition('tag', $tag);
		}
		if(isset($category)){
			$criteria->addSearchCondition('category_id', $category);
		}
		if(isset($month)){
			$criteria = array(
				'condition'=>'created > :time1 AND created < :time2 AND status=2',
				'params'=>array(
					':time1' => mktime(0,0,0,$month,1,$year),
					':time2' => mktime(0,0,0,$month+1,1,$year),
				),
			);
		}else{
			$criteria = new CDbCriteria(array(
				'condition' => ' status='.Post::STATUS_PUBLISHED,
				'order' => 'updated DESC',
				'with' => 'commentCount',
			));
		}


		



		$dataProvider = new CActiveDataProvider('Post', array(
			'pagination'=>array(
				'pageSize'=>3,
			),
			'criteria'=>$criteria,
		));
		
		$this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$this->layout = '//layouts/column3';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister()
	{
		$model=new User('register');

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='user-register-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['User']))
	    {
	    	$model->salt = 'jijianqiao';   //设置默认的密码加密前缀
	    	$model->attributes = $_POST['User'];

	        // $model->username 	= $_POST['User']['username'];
	        // $model->nickname	= $_POST['User']['nickname'];
	        $model->password 	= md5($model->salt.$_POST['User']['password']);
	        echo $model->password;
	        // $model->email 		= $_POST['User']['email'];
	        // $model->created     = $_SERVER['REQUEST_TIME'];
	        // $model->verifyCode  = $_POST['User']['verifyCode'];
	        
	        if($model->validate() && $model->save())
	        {
	            // form inputs are valid, do something here
	        	echo '注册成功！请登录';
	            //return $this->redirect(Yii::app()->user->returnUrl);
	        }
	    }

	    
	    $this->render('register',array('model'=>$model));
	}
}