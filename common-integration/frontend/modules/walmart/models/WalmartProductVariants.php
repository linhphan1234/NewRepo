<?php

namespace frontend\modules\walmart\models;

use Yii;

/**
 * This is the model class for table "walmart_product_variants".
 *
 * @property integer $id
 * @property integer $option_id
 * @property integer $product_id
 * @property integer $merchant_id
 * @property string $walmart_option_attributes
 * @property double $min_price
 * @property string $new_variant_option_1
 * @property string $new_variant_option_2
 * @property string $new_variant_option_3
 *
 * @property User $merchant
 * @property JetProductVariants $option
 */
class WalmartProductVariants extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'walmart_product_variants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_id', 'product_id', 'merchant_id'], 'required'],
            [['option_id', 'product_id', 'merchant_id'], 'integer'],
            [['walmart_option_attributes'], 'string'],
            [['min_price'], 'number'],
            [['new_variant_option_1', 'new_variant_option_2', 'new_variant_option_3'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_id' => 'Option ID',
            'product_id' => 'Product ID',
            'merchant_id' => 'Merchant ID',
            'walmart_option_attributes' => 'Walmart Option Attributes',
            'min_price' => 'Min Price',
            'new_variant_option_1' => 'New Variant Option 1',
            'new_variant_option_2' => 'New Variant Option 2',
            'new_variant_option_3' => 'New Variant Option 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerchant()
    {
        return $this->hasOne(User::className(), ['id' => 'merchant_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(JetProductVariants::className(), ['option_id' => 'option_id']);
    }
}
