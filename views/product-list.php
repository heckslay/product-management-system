<?php
/** @var [] $allProductsArr */
require_once('../controllers/ProductController.php');

use controllers\ProductController;
use models\Product;

$allProductsArr = ProductController::actionGetAllProducts();
?>
<div class="container product-list-container">
    <div class="row title-row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 responsive-col">
            <h2>Product List</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 responsive-col">
            <select class="form-control">
                <option value="Mass Delete Action">Mass Delete Action</option>
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 responsive-col">
            <button class="btn btn-primary btn-danger">Apply</button>
            <a href="index.php?pageName=add-product">
                <button class="btn btn-primary">Add</button>
            </a>
        </div>
    </div>
    <div class="row product-row">
        <?php if ($allProductsArr): ?>
            <?php foreach ($allProductsArr as $singleProduct): ?>
                <div class="col-xs-1 col-sm-4 col-md-3 col-lg-3">
                    <div class="single-product-box">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="itemCheck">
                            <label class="form-check-label" for="itemCheck">
                            </label>
                        </div>
                        <ul class="single-product-info" data-id="<?php echo $singleProduct['id'] ?>">
                            <li class="product-sku"><?php echo $singleProduct['sku']; ?></li>
                            <li class="product-name"><?php echo $singleProduct['name']; ?></li>
                            <li class="product-price"><?php echo $singleProduct['price']; ?></li>
                            <li class="product-special-property">
                                <?php
                                if($singleProduct['product_type_id'] == Product::TYPE_BOOK) {
                                    echo 'Weight: ' . $singleProduct['weight'];
                                } else if($singleProduct['product_type_id'] == Product::TYPE_DVD) {
                                    echo 'Size: ' . $singleProduct['size'];
                                } else if($singleProduct['product_type_id'] == Product::TYPE_FURNITURE) {
                                    echo 'Dimension: ' . $singleProduct['dimensions'];
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p class="no-entries-found">No Entries Found In Database</p>
            </div>
        <?php endif; ?>
    </div>
</div>
