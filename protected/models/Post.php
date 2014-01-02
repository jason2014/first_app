<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property string $id
 * @property string $title
 * @property string $content
 * @property string $summary
 * @property string $tags
 * @property string $status
 * @property string $created
 * @property string $updated
 * @property string $author_id
 * @property string $category_id
 */
class Post extends CActiveRecord
{
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ARCHIVED = 3;
	public $year;
	public $month;
	public $posts = 0;

	private $_oldTags;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post the static model class
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
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, summary, status, author_id', 'required'),
			array('title', 'length', 'max'=>128),
			array('summary', 'length', 'max'=>255),
			array('status, created, updated, author_id, category_id', 'length', 'max'=>11),
			array('tags', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			// array('id, title, content, summary, tags, status, created, updated, author_id, category_id', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),

			'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition'=>'comments.status='.Comment::STATUS_APPROVED, 'order'=>'comments.created DESC'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition' => 'status='.Comment::STATUS_APPROVED),

		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '标题',
			'content' => '内容',
			'summary' => '摘要',
			'tags' => '标签',
			'status' => '状态',
			'created' => '创建时间',
			'updated' => '更新时间',
			'author_id' => '作者ID',
			'category_id' => '评论ID',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('category_id',$this->category_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('post/view', array(
			'id'=>$this->id,
			'titile'=>$this->title,
		));
	}

	/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links = array();
		foreach(Tag::string2array($this->tags) as $tag)
		{
			$links[] = CHtml::link(CHtml::encode($tag), array('post/index', 'tag'=>$tag));
		}
		return $links;
	}

	public function findArchives()
	{
		return $this->findAll(array(
				'select' => 'YEAR(FROM_UNIXTIME(created)) AS `year`, MONTH(FROM_UNIXTIME(created)) AS `month`, count(`id`) AS posts',
				'condition' => 't.status='.self::STATUS_PUBLISHED,
				'group' => 'YEAR(FROM_UNIXTIME(created)), MONTH(FROM_UNIXTIME(created))',
				'order' => 't.created DESC',
		));
	}


	public function addComment($comment)
	{
		if(Yii::app()->params['commentNeedApproval'])
			$comment->status = Comment::STATUS_PENDING;
		else
			$comment->status = Comment::STATUS_APPROVED;
		
		$comment->post_id = $this->id;
		return $comment->save();
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->created = $this->updated = $_SERVER['REQUEST_TIME'];
				$this->author_id = Yii::app()->user->id;
			}
			else
				$this->updated = $_SERVER['REQUEST_TIME'];
			return true;
		}
		else
			return false;
	}
}