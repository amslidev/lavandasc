$("#lavandabundle_expedientecliente_decoloracion").change(function () {
    if( $("#lavandabundle_expedientecliente_decoloracion").is(":checked")){
        $("#lavandabundle_expedientecliente_cantidaddecoloracion").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_cantidaddecoloracion").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_planchadopermanente").change(function () {
    if( $("#lavandabundle_expedientecliente_planchadopermanente").is(":checked")){
        $("#lavandabundle_expedientecliente_cantidadplanchado").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_cantidadplanchado").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_tintes").change(function () {
    if( $("#lavandabundle_expedientecliente_tintes").is(":checked")){
        $("#lavandabundle_expedientecliente_cantidadtintes").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_cantidadtintes").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_alisadosprogresivos").change(function () {
    if( $("#lavandabundle_expedientecliente_alisadosprogresivos").is(":checked")){
        $("#lavandabundle_expedientecliente_cantidadalisados").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_cantidadalisados").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_alergiacosmetico").change(function () {
    if( $("#lavandabundle_expedientecliente_alergiacosmetico").is(":checked")){
        $("#lavandabundle_expedientecliente_nombrecosmetico").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_nombrecosmetico").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_alergiaquimico").change(function () {
    if( $("#lavandabundle_expedientecliente_alergiaquimico").is(":checked")){
        $("#lavandabundle_expedientecliente_nombrequimico").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_nombrequimico").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_productosacidos").change(function () {
    if( $("#lavandabundle_expedientecliente_productosacidos").is(":checked")){
        $("#lavandabundle_expedientecliente_nombreproductoacido").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_nombreproductoacido").attr("required", false);
    }
});

$("#lavandabundle_expedientecliente_usomedicamentos").change(function () {
    if( $("#lavandabundle_expedientecliente_usomedicamentos").is(":checked")){
        $("#lavandabundle_expedientecliente_nombremedicamentos").attr("required", true);
    }else{
        $("#lavandabundle_expedientecliente_nombremedicamentos").attr("required", false);
    }
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