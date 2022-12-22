$(function () {
  let amount = $("#amount");
  let every_amount = $("#every-amount");
  let all = $("#all-amount");
  every_amount.on("keyup", function () {
    let all_data = amount.val() * $(this).val();
    all.val(all_data);
  });
  amount.on("keyup", function () {
    let all_data = every_amount.val() * $(this).val();
    all.val(all_data);
  });

  let allProduct = $("#oneofproduct-all_amount");
  let onePrice = $("#oneofproduct-one_price");
  let allPrice = $("#oneofproduct-product_purchase_price");
  allProduct.on("keyup", function () {
    let all_data = onePrice.val() * $(this).val();
    allPrice.val(all_data);
  });
  onePrice.keyup(function (e) {
    let all_data = allProduct.val() * $(this).val();
    allPrice.val(all_data);
  });
});
