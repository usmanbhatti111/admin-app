function updateSerial() {
    count = 0;
    $(".count").each(function () {
        count++;
        $(this).html(count);
    });
    return count;
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode != 46 && charCode > 31
        && (charCode < 48 || charCode > 57))
        return false; 
    return true;
}

$(document).on('click', '.remove', function (e) {
    var row = $(this).closest('tr');
    // var table = $('.daily-sheet-table-body');
    $(row).remove();
    updateSerial();
    totalAmount();
    totalGbpAmount();
});

$(document).on('keyup', '.amount, .rate, .previous-balance', function (e) { 
    totalAmount(); 
});
$(document).on('keyup', '.addition', function (e) { 
    calculateActualBalance();
});

function calculateActualBalance(){
    var addition = $(".addition").val(); 
    var balance = $(".balance-input").val();
    total_profit = 0;
    if(addition=='' || addition== undefined || addition== NaN)addition = 0;
    if(balance == '' || balance == undefined || balance == NaN)balance = 0;

    actual_balance = parseFloat(balance) + parseFloat(addition); 
    $(".actual_balance").val(actual_balance.toFixed(2)); 
}
function calculateDailyProfit(){
    var gbp = $("#total-input-gbp-amount").val();
    
    var gp = $(".gp").val();
    total_profit = 0;
    if(gbp == '' || gbp == undefined || gbp == NaN|| gp=='' || gp== undefined || gp== NaN  ) {return};
    total_profit = parseFloat(gp) - parseFloat(gbp);

    console.log('total_profit: ', total_profit);
    $(".profit-daily-input").val(total_profit);
    $("#profit-daily-text").text(total_profit.toFixed(2));
}

function totalAmount(){ 
    var sum = 0;
    $('.amount').each(function () {
        var value = $(this).val() ;
        console.log("value: "+value);
        if (value != '' && value != ".") { 
            sum += +$(this).val();
        }
    });
    var sub_total = parseFloat(sum).toFixed(2); 
    $("#total-text-amount").html(sub_total);
    $("#total-input-amount").val(sub_total);
    calculateGpRate();
    calculateActualBalance();
}
function totalGbpAmount(){ 
    var sum = 0;
    $('.gbp').each(function () {
        var value = $(this).val() ; 
        if (value != '' && value != ".") { 
            sum += +$(this).val();
        }
    });
    var sub_total = parseFloat(sum).toFixed(2); 
    $("#total-gbp-amount").html(sub_total);
    $("#total-input-gbp-amount").val(sub_total);
    calculateDailyProfit();
}

$(document).on('change', '.operator', function (e) {  
    totalAmount();
});
$(document).on('keyup', '.gbp', function (e) {  
    totalGbpAmount();
});
function calculateGpRate(){
    var operator = $(".operator").val();
    var total = parseFloat($("#total-input-amount").val());
    var rate = parseFloat($(".rate").val()); 
    var gp_value = 0 ;
    switch (operator) {
        case "/":
            gp_value = total / rate;
        break;
        case "*": 
            gp_value = total * rate;
        break;
        case "+": 
            gp_value = total + rate;
        break;
        case "-": 
            gp_value = total - rate;
        break;
        default: 
        return; 
    }
    var gp_value = gp_value.toFixed(2);
    var prev_amount = parseFloat($(".previous-balance").val());
    var addition = parseFloat($(".addition").val());
    // console.log("addition: "+addition);
    // var balance = prev_amount - gp_value;
    var balance = (prev_amount - gp_value) + addition;

    

    $(".balance-input").val(balance);
    $(".balance-text").text(balance.toFixed(2));
    $('.gp').val(gp_value)
    totalGbpAmount();
}