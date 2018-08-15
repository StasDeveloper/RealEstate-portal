<?php

/**
 * This is the model class for table "{{landing_page}}".
 *
 * The followings are the available columns in table '{{landing_page}}':
 * @property integer $id
 * @property string $title
 * @property integer $status
 * @property integer $search_id
 * @property integer $post_top_id
 * @property integer $post_bottom_id
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Post $postBottom
 * @property Post $postTop
 * @property SavedSearches $search
 */
class LandingPage extends CActiveRecord {
    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;


    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{landing_page}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, search_id, status', 'required'),
            array('status, search_id, post_top_id, post_bottom_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
//            array('id, title, status, search_id, post_top_id, post_bottom_id, created_at, updated_at', 'safe', 'on' => 'search'),
            array('id, title, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'postBottom' => array(self::BELONGS_TO, 'Post', 'post_bottom_id'),
            'postTop' => array(self::BELONGS_TO, 'Post', 'post_top_id'),
            'search' => array(self::BELONGS_TO, 'SavedSearch', 'search_id'),
        );
    }

    public function behaviors() {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
                'updateAttribute' => 'updated_at',
            )
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
	    'status' => 'Status',
            'search_id' => 'Search',
            'post_top_id' => 'Post Top',
            'post_bottom_id' => 'Post Bottom',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('title', $this->title, true);
	$criteria->compare('status',$this->status);
//        $criteria->compare('search_id', $this->search_id);
//        $criteria->compare('post_top_id', $this->post_top_id);
//        $criteria->compare('post_bottom_id', $this->post_bottom_id);
//        $criteria->compare('created_at', $this->created_at, true);
//        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->with = array('search', 'postTop', 'postBottom');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'=>array(
                    'defaultOrder'=>'t.status, t.updated_at DESC',
            ),
        ));
        
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return LandingPage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the URL that shows the detail of the page
     */
    public function getUrl()
    {
            return Yii::app()->createUrl('landing/page/view', array(
                    'id'=>$this->id,
                    'slug'=>Doctrine_Inflector::urlize($this->title),
            ));
    }

}
