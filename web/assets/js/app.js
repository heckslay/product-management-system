$(document).ready(() => {
    const TYPE_BOOK = '1';
    const TYPE_DVD = '2';
    const TYPE_FURNITURE = '3';

    let $applyActionButton = $('.product-list-container #applyAction');

    let $addNewProductButton = $('.add-product-container #addProduct');
    let $typeSwitcher = $('.add-product-container #typeSwitcher');

    let $addProductForm = $('.add-product-form');


    $applyActionButton.click(() => {
        let $productDivs = $('.product-list-container .single-product-box');
        let $productDivsForAction = [];
        let $massActionDropdown = $('#massActionDropdown');
        let $productRow = $('.product-row');
        let params = {};
        let productIds = [];

        $productDivs.each((productDivKey, productDivValue) => {
            let $this = $(productDivValue);
            let $currCheckbox = $this.find('.form-check-input');
            if ($currCheckbox.is(':checked')) {
                $productDivsForAction.push($this.closest('.product-col'));
                productIds.push($this.attr('data-id'));
            }
        });
        if (productIds.length > 0) {
            if ($massActionDropdown.val() === 'delete') {
                params.action = 'delete';
                params.productIds = productIds;

                $.ajax({
                    url: 'request-digester.php',
                    data: params,
                    method: 'POST',
                    dataType: 'text',
                    success: function (data) {
                        if (data.success == false) {
                            alert('An Error Occurred When Deleting Products. Reverting.');
                        } else {
                            $productDivsForAction.forEach((productDivValue, productDivKey) => {
                                productDivValue.slideUp(() => {
                                    productDivValue.remove();
                                    $productDivs = $('.product-list-container .single-product-box');
                                    if ($productDivs.length === 0) {
                                        $productRow.append('<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product-col">\n' +
                                            '                <p class="no-entries-found">No Entries Found In Database</p>\n' +
                                            '            </div>');
                                    }
                                });

                            })
                        }
                    },
                });
            }
        } else {
            alert('Please, Select Products To Perform Mass Action.');
        }

    });

    $typeSwitcher.change(() => {
        $('.dynamic-input-block').remove();
        if ($typeSwitcher.val() === TYPE_BOOK) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="weight-input">Weight</label>\n' +
                '<input name="weight-input" class="dynamic-input" id="weightInput" type="number" required>' +
                '<p>Denotes The Weight Of The Book</p></div>');
        } else if ($typeSwitcher.val() === TYPE_DVD) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="size-input">Size</label>\n' +
                '<input name="size-input" class="dynamic-input" id="sizeInput" type="number" required>' +
                '<p>Denotes The Weight Of The DVD Disk in MB</p></div>');
        } else if ($typeSwitcher.val() === TYPE_FURNITURE) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="height-input">Height</label>\n' +
                '<input name="height-input" class="dynamic-input" id="heightInput" type="number" required>' +
                '<label for="width-input">Width</label>\n' +
                '<input name="width-input" class="dynamic-input" id="widthInput" type="number" required>' +
                '<label for="length-input">Length</label>\n' +
                '<input name="length-input" class="dynamic-input" id="lengthInput" type="number" required>' +
                '<p>Denotes The Dimensions of the Piece of Furniture</p></div>');
        }
    });


    $addNewProductButton.click(() => {
        let sku = $('#skuInput').val();
        let name = $('#nameInput').val();
        let price = $('#priceInput').val();
        let typeId = $('#typeSwitcher').val();
        let dynamicValues = [];
        let dynamicInputsFilled = true;
        $('.dynamic-input').each((key, value) => {
            console.log(value);
            if(key.val() === '') {
                dynamicInputsFilled = false;
                return false;
            }
            dynamicValues.push(key);
        });


        if (sku !== '' && name !== '' && price !== '' && dynamicVal !== '' && dynamicInputsFilled && typeId) {
            console.log(sku);
            console.log(name);
            console.log(price);
            console.log(typeId);
        } else {
            alert('Please, Fill In All Fields');
        }

    });

});