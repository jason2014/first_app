<?php

class AdminController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public $menu = array(
        array('label'=>'添加文章', 'icon'=>'pencil', 'url'=>array('/admin/create')),
        array('label'=>'文章管理', 'icon'=>'th-large', 'url'=>array('/admin/myPost')),
        array('label'=>'评论管理', 'icon'=>'minus-sign', 'url'=>array('/admin/comment')),
    );

    /**
     * @return array action filters
     */
    // public function filters()
    // {
    //  return array(
    //      'accessControl', // perform access control for CRUD operations
    //      'postOnly + delete', // we only allow deletion via POST request
    //  );
    // }

    // /**
    //  * Specifies the access control rules.
    //  * This method is used by the 'accessControl' filter.
    //  * @return array access control rules
    //  */
    // public function accessRules()
    // {
    //  return array(
    //      array('allow',  // allow all users to perform 'index' and 'view' actions
    //          'actions'=>array('index','view'),
    //          'users'=>array('*'),
    //      ),
    //      array('allow', // allow authenticated user to perform 'create' and 'update' actions
    //          'actions'=>array('create','update'),
    //          'users'=>array('@'),
    //      ),
    //      array('allow', // allow admin user to perform 'admin' and 'delete' actions
    //          'actions'=>array('admin','delete'),
    //          'users'=>array('admin'),
    //      ),
    //      array('deny',  // deny all users
    //          'users'=>array('*'),
    //      ),
    //  );
    // }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Post;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Post']))
        {
            // print_r($_POST['Post']);exit;
            $model->attributes=$_POST['Post'];

            $model->author_id = Yii::app()->user->id;
            $model->created = $_SERVER['REQUEST_TIME'];

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
            else
                print_r($model->getErrors());

        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Post']))
        {
            $model->attributes=$_POST['Post'];
            $model->updated = $_SERVER['REQUEST_TIME'];

            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Post');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Post('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Post']))
            $model->attributes=$_GET['Post'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Post::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Post $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    //我的文章
    public function actionMyPost()
    {

        $user_id = Yii::app()->user->id;
        $sql = "SELECT 
                  `jjq_post`.*,
                  `jjq_user`.`username`,
                  COUNT(`jjq_comment`.`id`) AS comment_count
                FROM
                  `jjq_post` 
                  LEFT JOIN `jjq_user` 
                    ON `jjq_user`.`id` = `jjq_post`.`author_id` 
                  LEFT JOIN `jjq_comment` 
                    ON `jjq_comment`.`post_id` = `jjq_post`.`id` 
        ";
        $where = " WHERE `jjq_user`.`id`={$user_id} ";
        $groupBy = " GROUP BY `jjq_post`.`id` ";

        $sql .= $where;
        $sql .= $groupBy;

        //排序
        $sort = new CSort();
        $sort->attributes = array(
            'id',
            'created',
            'updated',
            'comment_count',
        );
        $orderBy = isset($_GET['sort']) ? $_GET['sort'] : '';
        // if(isset($_GET['sort'])){
            switch($orderBy)
            {
                case 'id':
                    $sql .= " ORDER BY `jjq_post`.`id` desc ";
                    break;
                case 'id.desc':
                    $sql .= " ORDER BY `jjq_post`.`id` asc ";
                    break;
                case 'created':
                    $sql .= " ORDER BY `jjq_post`.`created` desc ";
                    break;
                case 'created.desc':
                    $sql .= " ORDER BY `jjq_post`.`created` asc ";
                    break;
                case 'updated':
                    $sql .= " ORDER BY `jjq_post`.`updated` desc ";
                    break;
                case 'updated.desc':
                    $sql .= " ORDER BY `jjq_post`.`updated` asc ";
                    break;
                case 'comment_count':
                    $sql .= " ORDER BY `comment_count` desc ";
                    break;
                case 'comment_count.desc':
                    $sql .= " ORDER BY `comment_count` asc ";
                    break;
                default:
                    $sql .= " ORDER BY `jjq_post`.`created` desc ";
            }
        // }
        // echo $sql;
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        // print_r($data);

        //分页
        $pages = new CPagination(count($data));
        $pages->pageSize = 10;

        $model=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
        $model->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
        $model->bindValue(':limit', $pages->pageSize);    
        $model=$model->queryAll(); 

        // print_r($model);
        //对读取的数据进行处理
        foreach ($model as $key => $value) {
            $model[$key]['created'] = date('Y-m-d H:i:s', $value['created']); 
            $model[$key]['updated'] = date('Y-m-d H:i:s', $value['updated']);
        }

        // $model->unsetAttributes();  // clear any default values

        $this->render('myPost', array(
            'model' => $model,
            'pages' => $pages,
            'sort' => $sort,
        ));
    }

    public function actionComment()
    {
        $user_id = Yii::app()->user->id;
        $sql = "SELECT 
                  `jjq_comment`.*,
                  `jjq_post`.`title` 
                FROM
                  `jjq_comment` 
                LEFT JOIN `jjq_post` 
                  ON `jjq_post`.`id` = `jjq_comment`.`post_id` 
        ";

        $where = " WHERE `jjq_post`.`author_id` ={$user_id} ";
        $sql .= $where;

        //排序
        $sort = new CSort();
        $sort->attributes = array(
            'id',
            'status',
            'created',
        );

        $sort->defaultOrder = 'status';
        $sql .= ' ORDER BY '.$sort->orderBy;

        $data = Yii::app()->db->createCommand($sql)->queryAll();

        //分页
        $pages = new CPagination(count($data));
        $pages->pageSize = 10;

        $model=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");    
        $model->bindValue(':offset', $pages->currentPage*$pages->pageSize);    
        $model->bindValue(':limit', $pages->pageSize);    
        $models=$model->queryAll(); 

        $this->render('comment', array(
            'models'=> $models,
            'pages' => $pages,
            'sort' => $sort,
        ));
    }

    public function actionCommentUpdate($id)
    {
        $model = Comment::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

        if(isset($_POST['Comment']))
        {
            $model->attributes=$_POST['Comment'];

            if($model->save())
                $this->redirect(array('commentView','id'=>$model->id));
        }


        $this->render('commentUpdate', array(
            'model'=>$model,
        ));

    }

    public function actionCommentView($id)
    {   
        $model = Comment::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404, 'The requested page does not exist.');


        $this->render('commentView', array(
            'model'=>$model,
        ));

    }

    //文章删除ajax判断
    public function actionPostDelete()
    {
        $id = $_POST['id'];
        $model=Post::model()->findByPk($id);
        if($model===null)
            echo 2;  //删除失败
        else
        {
            $model->delete();
            echo 1;
        }

        Yii::app()->end();
    }

    //评论删除ajax判断
    public function actionCommentDelete()
    {
        $id = $_POST['id'];
        $model = Comment::model()->findByPk($id);
        if($model===null)
            echo 2;  //删除失败
        else
        {
            $model->delete();
            echo 1;
        }

        Yii::app()->end();
    }

    //评论审核通过
    public function actionCommentStatusGo()
    {
        $id = $_POST['id'];
        $count = Comment::model()->updateByPk($id, array('status'=>2 ));
        if($count>0)
        {
            echo 1; //成功
        }
        else
        {
            echo 2; //失败
        }
    }


}
