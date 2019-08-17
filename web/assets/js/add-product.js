$(document).ready(() => {

    const TYPE_BOOK = '1';
    const TYPE_DVD = '2';
    const TYPE_FURNITURE = '3';

    let $addNewProductButton = $('.add-product-container #addProduct');
    let $typeSwitcher = $('.add-product-container #typeSwitcher');

    let $addProductForm = $('.add-product-form');

    $typeSwitcher.change(() => {
        changeDynamicInput();
    });


    $addNewProductButton.click(() => {
        addNewProduct();
    });


    function addNewProduct() {
        let sku = $('#skuInput').val();
        let name = $('#nameInput').val();
        let price = $('#priceInput').val();
        let typeId = $('#typeSwitcher').val();
        let dynamicValues = [];
        let dynamicInputsFilled = true;
        let params = {};
        $('input[class="dynamic-input"]').each((key, value) => {
            if ($.trim($(value).val()) == '') {
                dynamicInputsFilled = false;
                return false;
            }
            dynamicValues.push($(value).val());
        });

        if (sku !== '' && name !== '' && price !== '' && dynamicInputsFilled && typeId) {
            params.action = 'add';
            params.productInfo = {
                sku: sku,
                name: name,
                price: price,
                type: typeId,
                dynamicValues: dynamicValues
            };


            $.ajax({
                url: 'request-digester.php',
                data: params,
                method: 'POST',
                dataType: 'text',
                success: function (data) {
                    if (data.success == false) {
                        alert('An Error Occurred When Adding Product.');
                    } else {
                        $('input').each((key, value) => {
                            $(value).val('');
                        });

                        alert('Product Was Added Successfully.');
                    }
                },
            });

        } else {
            alert('Please, Fill In All Fields');
        }
    }

    function changeDynamicInput() {
        $('.dynamic-input-block').remove();
        if ($typeSwitcher.val() === TYPE_BOOK) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="weight-input">Weight</label>\n' +
                '<input name="weight-input" class="dynamic-input" id="weightInput" type="number" required>' +
                '<p class="dynamic-input-description">Denotes The Weight Of The Book</p></div>');
        } else if ($typeSwitcher.val() === TYPE_DVD) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="size-input">Size</label>\n' +
                '<input name="size-input" class="dynamic-input" id="sizeInput" type="number" required>' +
                '<p class="dynamic-input-description">Denotes The Weight Of The DVD Disk in MB</p></div>');
        } else if ($typeSwitcher.val() === TYPE_FURNITURE) {
            $addProductForm.append('<div class="dynamic-input-block">' +
                '<label for="height-input">Height</label>\n' +
                '<input name="height-input" class="dynamic-input" id="heightInput" type="number" required>' +
                '<label for="width-input">Width</label>\n' +
                '<input name="width-input" class="dynamic-input" id="widthInput" type="number" required>' +
                '<label for="length-input">Length</label>\n' +
                '<input name="length-input" class="dynamic-input" id="lengthInput" type="number" required>' +
                '<p class="dynamic-input-description">Denotes The Dimensions of the Piece of Furniture</p></div>');
        }
    }

});