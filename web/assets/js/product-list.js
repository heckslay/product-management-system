$(document).ready(() => {

    let $applyActionButton = $('.product-list-container #applyAction');

    $applyActionButton.click(() => {
        batchDelete();
    });


    function batchDelete()
    {
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
    }

});