$(document).ready(() => {

    // Dom Elements we save in variable for easier access
    let $applyActionButton = $('.product-list-container #applyAction');


    // Products batch delete button click callback
    $applyActionButton.click(() => {
        batchDelete();
    });

    // Handles batch deletion of the products
    function batchDelete()
    {
        // Variable declaration, DOM elements assignment for easier access
        let $productDivs = $('.product-list-container .single-product-box');
        let $productDivsForAction = [];
        let $massActionDropdown = $('#massActionDropdown');
        let $productRow = $('.product-row');
        let params = {};
        let productIds = [];

        /*
        * Loop through the product divs, save selected ones in the specific array
        */
        $productDivs.each((productDivKey, productDivValue) => {
            let $this = $(productDivValue);
            let $currCheckbox = $this.find('.form-check-input');
            if ($currCheckbox.is(':checked')) {
                $productDivsForAction.push($this.closest('.product-col'));
                productIds.push($this.attr('data-id'));
            }
        });

        // If items to delete array contains elements, proceed
        if (productIds.length > 0) {
            if ($massActionDropdown.val() === 'delete') {
                // Set the ajax request params
                params.action = 'delete';
                params.productIds = productIds;

                // Perform ajax request
                $.ajax({
                    url: 'request-digester.php',
                    data: params,
                    method: 'POST',
                    dataType: 'text',
                    success: function (data) {
                        if (data.success == false) {
                            alert('An Error Occurred When Deleting Products. Reverting.');
                        } else {
                            // If success, loop through the divs and remove ones which were deleted in database
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
    }

});