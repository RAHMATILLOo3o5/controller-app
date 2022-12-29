$(function () {
    let min_price = $("#sell-min-back");
    let max_price = $("#sell-max-back");
    let product_id = $("#product");
    let type_sell = $("#sell-type");
    let form = $("#sell-form");
    let action = form.attr("action");
    let sell_amount = $("#sell_amount");
    let sell_all_min = $("#sell-all-min-back");
    let sell_all_max = $("#sell-all-max-back");
    let pay_amount = $("#sell");
    let submitButton = $("#submit_button2");
    product_id.on("change", function (e) {
        e.preventDefault();
        let product_id_val = $(this).val();
        let type_sell_val = type_sell.val();
        if (product_id_val !== "" && product_id_val !== null) {
            getPrice(product_id_val, type_sell_val);
        } else {
            console.log("xayr");
        }
    });

    type_sell.on("change", function () {
        getPrice(product_id.val(), $(this).val());
    });
    sell_amount.on("keyup", function () {
        let min_pay = min_price.val() * $(this).val();
        let max_pay = max_price.val() * $(this).val();
        sell_all_min.val(min_pay);
        sell_all_max.val(max_pay);
    });

    pay_amount.on("keyup", function () {
        let a = $(this).val();
        let b = sell_all_min.val() * 1;
        let c = sell_all_max.val() * 1;
        if (a < b || a > c) {
            submitButton.addClass("disabled");
        } else {
            submitButton.removeClass("disabled");
        }
    });

    function getPrice(product_id, type_sell) {
        $.post(
            action,
            { product_id: product_id, type_sell: type_sell },
            function (data, textStatus, jqXHR) {
                min_price.val(data.min);
                max_price.val(data.max);
            },
            "json"
        );
    }
});
