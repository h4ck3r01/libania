//loading

let loading = $('#loading');

$(document)
    .ajaxStart(function () {
        loading.fadeIn();
        $("#content").addClass('z-index');
    })
    .ajaxStop(function () {
        loading.fadeOut();
        $("#content").removeClass('z-index');
    });

//alert
$('.alert').delay(3000).fadeOut();

//select2
$('.select2').select2({
    width: '100%',
    language: 'pt-BR',
});

//reset
$(':reset').on('click', function (e) {

    e.preventDefault();

    $('form')[0].reset();

    $('.select2').trigger('change');
});

//mask-money
$(".money").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    'placeholder': ''
});

//mask-phone
$(".phone").inputmask("(99)9999-9999[9]", {
    placeholder: " ",
    clearMaskOnLostFocus: true,
    clearIncomplete: true
});

//currency
function formatMoney(val) {
    var num_ = val.split(/\.|,/);
    val = num_.slice(0, -1).join('') + '.' + num_.slice(-1);
    return Number(val);
}

function parseMoney(str) {

    str = str.toFixed(2);

    str = str.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    var posX = str.lastIndexOf('.');
    var posY = str.lastIndexOf(',');
    if (posX !== -1 && posY === -1) {
        str = str.substring(0, posX) + ',' + str.substring(posX + 1);
    }

    return str;
}