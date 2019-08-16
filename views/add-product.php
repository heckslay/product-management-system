<div class="container add-product-container">
    <div class="row title-row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 responsive-col">
            <h2>Add Product</h2>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-1 responsive-col">
            <button class="btn btn-primary btn-success responsive-button">Save</button>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 responsive-col">
           <a href="index.php?pageName=product-list"><button class="btn btn-primary responsive-button">Products</button></a>
        </div>
    </div>
    <div class="row form-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 responsive-col">
            <form class="add-product-form">
                <label for="sku-input">SKU</label>
                <input name="sku-input" type="text" required>
                <label for="name-input">Name</label>
                <input name="name-input" type="text" required>
                <label for="price-input">Name</label>
                <input name="price-input" type="text" required>
                <label for="type-switcher">Type Switcher</label>
                <select name="type-switcher">
                    <option value="Type Switcher">Type Switcher</option>
                </select>
                <div class="generic-type-input-block">
                </div>
            </form>
        </div>
    </div>
</div>