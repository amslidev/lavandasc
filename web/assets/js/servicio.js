$("#lavandabundle_servicio_precio").change(function () {
    var costo = $(this).val();
    var total = costo.replace(/,/g, "");
    $(this).val(total);
});

$("#lavandabundle_producto_precio").change(function () {
    var costo = $(this).val();
    var total = costo.replace(/,/g, "");
    $(this).val(total);
});

function valideKey(evt){

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if(code==8) { // backspace.
        return true;
    } else if(code>=48 && code<=57) { // is a number.
        return true;
    } else{ // other keys.
        return false;
    }
}