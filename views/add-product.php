<?php
/*
* A view for adding product.
*/
/** @var [] $typesArr */

require_once('../models/Product.php');

use models\Product;

$typesArr = Product::getTypesAssocArr();
?>
<div class="container add-product-container">
    <div class="row title-row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 responsive-col">
            <h2>Add Product</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-1 responsive-col">
            <button class="btn btn-primary btn-success responsive-button" id="addProduct">Save</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 responsive-col">
           <a href="index.php?pageName=product-list"><button class="btn btn-primary responsive-button">Products</button></a>
        </div>
    </div>
    <div class="row form-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 responsive-col">
                <form class="add-product-form">
                <label for="sku-input">SKU</label>
                <input name="sku-input" id="skuInput" type="text" required>
                <label for="name-input">Name</label>
                <input name="name-input" id="nameInput" type="text" required>
                <label for="price-input">Price</label>
                <input name="price-input" id="priceInput" type="number" required>
                <label for="type-switcher">Type Switcher</label>
                <select name="type-switcher" id="typeSwitcher">
                    <option value="0" disabled selected>Select Type</option>
                    <?php foreach ($typesArr as $typeKey => $typeValue): ?>
                        <option value="<?php echo $typeValue ?>"><?php echo $typeKey ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="generic-type-input-block">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="assets/js/add-product.js"></script>
