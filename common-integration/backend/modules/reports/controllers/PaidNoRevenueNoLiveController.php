<?php

namespace backend\modules\reports\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use backend\modules\reports\components\Data;
use backend\modules\reports\models\CustomQuerySearch;

/**
 * PaidNoRevenueNoLiveController
 */
class PaidNoRevenueNoLiveController extends BaseController
{

    /**
     * Lists all JetExtensionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $type = Yii::$app->getRequest()->getQueryParam('type')?:'daily';
        $table = Data::EXTENSIONS_TABLE;
        $table1 = Data::JET_PRODUCT_TABLE;
        $table2 = Data::ORDER_TABLE;
        $sql = "SELECT count( `jod`.`merchant_id` ) AS `count`,count( `jp`.`merchant_id` ) AS `live_products` , `jed`.`merchant_id` as `merchant_id`,`jed`.`merchant_id` as `id`,`jed`.`email` as `email`,`jed`.`purchase_status`,`jed`.`install_status`,`jed`.`expired_on`,`jed`.`shop_url` FROM `{$table}` AS `jed` LEFT JOIN `{$table1}` `jp` ON `jed`.`merchant_id` = `jp`.`merchant_id` AND `jp`.`status`='Available for Purchase' LEFT JOIN `{$table2}` `jod` ON `jed`.`merchant_id` = `jod`.`merchant_id` AND `jod`.`status` = 'complete'  WHERE `jed`.`purchase_status` = 'Purchased' GROUP BY `jed`.`merchant_id`";
        

        $searchModel = new CustomQuerySearch();
        $searchModel->andFilterWhere(['lt','count',1]);
        $searchModel->andFilterWhere(['lt','live_products',1]);
        $searchModel->setCustomQuery($sql);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);        
    }
}