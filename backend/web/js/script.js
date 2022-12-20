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

});
