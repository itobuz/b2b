<?php

/**
 * This is the model class for table "listing".
 *
 * The followings are the available columns in table 'listing':
 * @property integer $id
 * @property string $orderType
 * @property string $commodityName
 * @property string $productType
 * @property integer $orderQty
 * @property string $deliveryDate
 * @property string $paymentDate
 * @property double $price
 * @property integer $state
 * @property integer $city
 * @property integer $kms
 * @property string $paymentTerms
 * @property string $expireTime
 * @property string $tradeType
 * @property string $specialRequirments
 * @property string $commodityTestReport
 * @property string $deliveryAddress
 * @property string $lat
 * @property string $long
 * @property strinng $userId
 * The followings are the available model relations:
 * @property Bid[] $bs
 * @property State $state0
 * @property City $city0
 */
class Listing extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Listing the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'listing';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('commodityName, orderQty, deliveryDate, paymentDate, price, paymentTerms, expireTime, tradeType,listingHeading', 'required'),
            array('orderQty, state, city, kms', 'numerical', 'integerOnly' => true),
            array('price', 'numerical'),
            array('orderType', 'length', 'max' => 4),
            array('commodityName, paymentTerms', 'length', 'max' => 6),
            array('productType', 'length', 'max' => 11),
            array('tradeType', 'length', 'max' => 12),
            array('lat, long', 'length', 'max' => 50),
            array('specialRequirments, deliveryAddress', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, orderType, commodityName,listingHeading, productType, orderQty, deliveryDate, paymentDate, price, state, city, kms, paymentTerms, expireTime, tradeType, specialRequirments, commodityTestReport, deliveryAddress, lat, long', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'bs' => array(self::HAS_MANY, 'Bid', 'listId'),
            'bidCount' => array(self::STAT, 'Bid', 'listId'),
            'state0' => array(self::BELONGS_TO, 'State', 'state'),
            'city0' => array(self::BELONGS_TO, 'City', 'city'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'orderType' => 'Order Type',
            'commodityName' => 'Commodity Name',
            'productType' => 'Product Type',
            'orderQty' => 'Order Qty',
            'deliveryDate' => 'Delivery Date',
            'paymentDate' => 'Payment Date',
            'price' => 'Price',
            'state' => 'State',
            'city' => 'City',
            'kms' => 'Maximum delivery distance(Kms)',
            'paymentTerms' => 'Payment Terms',
            'expireTime' => 'Expire Date',
            'tradeType' => 'Trade Type',
            'specialRequirments' => 'Special Requirments',
            'commodityTestReport' => 'Commodity Test Report',
            'deliveryAddress' => 'Delivery Address',
            'lat' => 'Latitude',
            'long' => 'Longitude',
            'listingHeading' => 'Listing Title',
            'userId' => 'userId'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $sort = new CSort();
        $sort->attributes = array(
            'id' => array(
                'asc' => 'id',
                'desc' => 'id desc',
            ),
            'listingHeading' => array(
                'asc' => 'listingHeading',
                'desc' => 'listingHeading desc',
            ),
            'productType' => array(
                'asc' => 'productType',
                'desc' => 'productType desc',
            ),
            'commodityName' => array(
                'asc' => 'commodityName',
                'desc' => 'commodityName desc',
            ),
        );

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('orderType', $this->orderType, true);
        $criteria->compare('commodityName', $this->commodityName, true);
        $criteria->compare('listingHeading', $this->listingHeading, true);
        $criteria->compare('productType', $this->productType, true);
        $criteria->compare('orderQty', $this->orderQty);
        $criteria->compare('deliveryDate', $this->deliveryDate, true);
        $criteria->compare('paymentDate', $this->paymentDate, true);
        $criteria->compare('price', $this->price);
        $criteria->compare('state', $this->state);
        $criteria->compare('city', $this->city);
        $criteria->compare('kms', $this->kms);
        $criteria->compare('paymentTerms', $this->paymentTerms, true);
        $criteria->compare('expireTime', $this->expireTime, true);
        $criteria->compare('tradeType', $this->tradeType, true);
        $criteria->compare('specialRequirments', $this->specialRequirments, true);
        $criteria->compare('commodityTestReport', $this->commodityTestReport, true);
        $criteria->compare('deliveryAddress', $this->deliveryAddress, true);
        $criteria->compare('lat', $this->lat, true);
        $criteria->compare('long', $this->long, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => $sort,
                ));
    }

    public function prepareReportLinks() {
        $path = Yii::app()->request->baseUrl . Yii::app()->params['commTestDir'];
        $filename = $this->commodityTestReport;
        if (empty($filename))
            return '';
        $files = explode('|', $filename);

        $links = array();
        $count = count($files);
        for ($i = 1; $i <= $count; $i++) {
            $links[] = '<li><a href="' . $path . $files[$i - 1] . '" title="download report ' . $i . '">Download report ' . $i . '</a></li>';
        }
        if (!empty($links))
            return '<ul>' . implode("\r\n", $links) . '</ul>';
        else
            return "";
    }

    function beforeSave() {
        $this->userId = Yii::app()->user->id;
        return true;
    }

}