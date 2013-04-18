<?php

/**
 * This is the model class for table "bid".
 *
 * The followings are the available columns in table 'bid':
 * @property string $id
 * @property integer $listId
 * @property string $userId
 * @property double $amount
 * @property string $comment
 * @property string $bidStatus
 *
 * The followings are the available model relations:
 * @property Listing $list
 * @property User $user
 * @property Biddetails[] $biddetails
 */
class Bid extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Bid the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'bid';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('listId, userId, amount', 'required'),
            array('listId', 'numerical', 'integerOnly' => true),
            array('amount', 'numerical'),
            array('userId', 'length', 'max' => 50),
            array('comment', 'length', 'max' => 1024),
            array('bidStatus', 'length', 'max' => 8),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, listId, userId, amount, comment, bidStatus', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'list' => array(self::BELONGS_TO, 'Listing', 'listId'),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'biddetails' => array(self::HAS_MANY, 'Biddetails', 'bidId'),
            
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'listId' => 'List',
            'userId' => 'User',
            'amount' => 'Amount',
            'comment' => 'Comment',
            'bidStatus' => 'Bid Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('listId', $this->listId);
        $criteria->compare('userId', $this->userId, true);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('bidStatus', $this->bidStatus, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}