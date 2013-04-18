<?php

/**
 * This is the model class for table "livefuture".
 *
 * The followings are the available columns in table 'livefuture':
 * @property string $id
 * @property string $productName
 * @property string $expiryDate
 * @property double $open
 * @property double $high
 * @property double $low
 * @property double $close
 * @property double $lastTradedPrice
 * @property double $change
 * @property double $changePercentage
 * @property double $AverageTradePrice
 * @property double $spotPrice
 * @property double $bestBuy
 * @property double $bestSell
 * @property double $openInterest
 * @property string $timestamp
 */
class Livefuture extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Livefuture the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'livefuture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('productName, expiryDate, open, high, low, close, lastTradedPrice, change, changePercentage, AverageTradePrice, spotPrice, bestBuy, bestSell, openInterest', 'required'),
            array('open, high, low, close, lastTradedPrice, change, changePercentage, AverageTradePrice, spotPrice, bestBuy, bestSell, openInterest', 'numerical'),
            array('productName', 'length', 'max' => 256),
            array('showOnHome','safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, productName, expiryDate, open, high, low, close, lastTradedPrice, change, changePercentage, AverageTradePrice, spotPrice, bestBuy, bestSell, openInterest, timestamp', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'id' => 'ID',
        'productName' => 'Product Name',
        'showOnHome' => 'Show On Homepage' ,
        'expiryDate' => 'Expiry Date',
        'open' => 'Open',
        'high' => 'High',
        'low' => 'Low',
        'close' => 'Close',
        'lastTradedPrice' => 'Last Traded Price',
        'change' => 'Change',
        'changePercentage' => 'Change Percentage',
        'AverageTradePrice' => 'Average Trade Price',
        'spotPrice' => 'Spot Price',
        'bestBuy' => 'Best Buy',
        'bestSell' => 'Best Sell',
        'openInterest' => 'Open Interest',
        'timestamp' => 'Timestamp',
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
        $criteria->compare('productName', $this->productName, true);
        $criteria->compare('expiryDate', $this->expiryDate, true);
        $criteria->compare('open', $this->open);
        $criteria->compare('high', $this->high);
        $criteria->compare('low', $this->low);
        $criteria->compare('close', $this->close);
        $criteria->compare('lastTradedPrice', $this->lastTradedPrice);
        $criteria->compare('change', $this->change);
        $criteria->compare('changePercentage', $this->changePercentage);
        $criteria->compare('AverageTradePrice', $this->AverageTradePrice);
        $criteria->compare('spotPrice', $this->spotPrice);
        $criteria->compare('bestBuy', $this->bestBuy);
        $criteria->compare('bestSell', $this->bestSell);
        $criteria->compare('openInterest', $this->openInterest);
        $criteria->compare('timestamp', $this->timestamp, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}