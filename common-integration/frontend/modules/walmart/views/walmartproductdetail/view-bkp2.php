<?php
/**
 * Created by PhpStorm.
 * User: cedcoss
 * Date: 17/7/17
 * Time: 12:34 PM
 */
use yii\helpers\Html;

/*
$html = '<table class="table table-striped table-bordered product_detail" cellspacing="0" width="100%"><tbody>';
foreach ($data as $key => $value) {

    if ($key == 'ITEM PAGE URL') {
        if (!empty($value)) {
            $html .= '
        <tr>
            <td class="value_label" width="33%">
                <strong>' . strtoupper($key) . '</strong>
            </td>
            <td class="value form-group " width="100%">
                <a href="' . $value . '" target="_blank">' . $value . '</a>
                
            </td>
        </tr>';
        }
    } elseif ($key == 'PRIMARY IMAGE URL') {
        if (!empty($value)) {
            $html .= '
        <tr>
            <td class="value_label" width="33%">
                <strong>' . strtoupper($key) . '</strong>
            </td>
            <td class="value form-group " width="100%">
                <a href="' . $value . '" target="_blank"><img src="' . $value . '" class="image_hover" width="100" height="100"></a>
            </td>
        </tr>';
        }

    } else {
        if (!empty($value)) {
            $html .= '
        <tr>
            <td class="value_label" width="33%">
                <strong>' . strtoupper($key) . '</strong>
            </td>
            <td class="value form-group " width="100%">
                <span>' . $value . '</span>
                
            </td>
        </tr>';
        }
    }

}
$html .= '</tbody></table>';*/
?>
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title" style="text-align: center;font-family: " Comic Sans MS";">Product
                    Information on Walmart</h2>
                </div>
                <div class="modal-body">
                    <div class="product_content">

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <?php
                                if ($data['PRIMARY IMAGE URL']) { ?>
                                    <div>
                                        <a href="<?= $data['PRIMARY IMAGE URL'] ?>" target="_blank"><img
                                                    src="<?= $data['PRIMARY IMAGE URL'] ?>"
                                                    class="image_hover"
                                                    alt="Product Image" width="250"
                                                    height="250"></a>
                                    </div>

                                <?php }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <h3>Product Information</h3>
                                <div>
                                    <?php
                                    if ($data['ITEM PAGE URL']) { ?>

                                        <!--<label>Click Here To </label>-->
                                        <a href="<?= $data['ITEM PAGE URL'] ?>" target="_blank">View on site&nbsp;<i class="fa fa-share-square-o"></i></a>
                                    <?php }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($data['SKU']) { ?>

                                        <label>SKU</label>
                                        <span><?= $data['SKU'] ?></span>
                                    <?php }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($data['PRICE']) { ?>

                                        <label>Price</label>
                                        <span><?= $data['PRICE'] ?></span>
                                        <small><?= $data['CURRENCY'] ?></small>
                                    <?php }
                                    ?>
                                </div>

                                <div>
                                    <?php
                                    if ($data['INVENTORY COUNT']) { ?>

                                        <label>Inventory Count</label>
                                        <span><?= $data['INVENTORY COUNT'] ?></span>
                                    <?php }
                                    ?>
                                </div>
                                <div>
                                    <?php
                                    if ($data['PUBLISH STATUS']) { ?>

                                        <label>Publish Status</label>
                                        <span><?= $data['PUBLISH STATUS'] ?></span>
                                    <?php }
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="heading">
                                <h3>Detailed Information ... </h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <?php
                                    if ($data['PRODUCT NAME']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Product Name</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['PRODUCT NAME'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['SHIP METHODS']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Ship Method</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['SHIP METHODS'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['SHELF NAME']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Shelf Name</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['SHELF NAME'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div><div class="row">
                                    <?php
                                    if ($data['ITEM CREATION DATE']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Item Creation Date</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['ITEM CREATION DATE'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div><div class="row">
                                    <?php
                                    if ($data['ITEM LAST UPDATED']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Item Last Updated</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['ITEM LAST UPDATED'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div><div class="row">
                                    <?php
                                    if ($data['WPID']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>WPID</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['WPID'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="row">
                                    <?php
                                    if ($data['PRODUCT CATEGORY']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Product Category</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['PRODUCT CATEGORY'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['UPC']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>UPC</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['UPC'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['GTIN']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>GTIN</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['GTIN'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['OFFER START DATE']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Offer Start Date</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['OFFER START DATE'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['OFFER END DATE']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Offer End Date</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['OFFER END DATE'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                                <div class="row">
                                    <?php
                                    if ($data['ITEM ID']) { ?>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Item Id</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <span><?= $data['ITEM ID'] ?></span>
                                        </div>
                                    <?php }
                                    ?>
                                </div>

                            </div>
                        </div>
                        <!--<div class="row">
                            <div class="heading">
                                <h3>Detailed Information ... </h3>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <?php
                        /*                                    if ($data['PRODUCT NAME']) { */ ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Product Name</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                                            <span><? /*= $data['PRODUCT NAME'] */ ?></span>
                                        </div>
                                    <?php /*}
                                    */ ?>
                                </div>
                                <div class="row">
                                    <?php
                        /*                                    if ($data['PRODUCT CATEGORY']) { */ ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                                            <label>Product Category</label>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

                                            <span><? /*= $data['PRODUCT CATEGORY'] */ ?></span>
                                        </div>
                                    <?php /*}
                                    */ ?>
                                </div>
                            </div>
                        </div>-->

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .form-group {
        margin: 0 0 0;
    }
    .modal-dialog{
        width: 800px;
    }
</style>
