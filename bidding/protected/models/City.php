<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property integer $id
 * @property string $name
 * @property integer $stateId
 *
 * The followings are the available model relations:
 * @property State $state
 * @property Listing[] $listings
 * @property User[] $users
 */
class City extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return City the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'city';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, stateId', 'required'),
            array('stateId', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, stateId', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'state' => array(self::BELONGS_TO, 'State', 'stateId'),
            'listings' => array(self::HAS_MANY, 'Listing', 'city'),
            'users' => array(self::HAS_MANY, 'User', 'city'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'name' => 'Name',
            'stateId' => 'State',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('stateId', $this->stateId);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getNameById($id) {
        $sql = "SELECT name FROM city WHERE id = " . (int) $id;
        $result = Yii::app()->db->createCommand($sql)->queryAll(true);
        if (!$result)
            return 'Unknown City';
        return $result[0]['name'];
    }

    public function getIdByName($name) {
        $name = strtolower($name);
        $sql = "SELECT id FROM city WHERE name LIKE '{$name}'";
        $result = Yii::app()->db->createCommand($sql)->queryAll(true);
        if (!$result)
            return 'Unknown City';
        return $result[0]['id'];
    }

}