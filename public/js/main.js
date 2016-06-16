/*
 * Funciones JS para el sitio web en general
 */

$(document).ready(function(){

    //Permite solo ingresar numeros para campos con el atributo class="number"
    $(".number").on('keydown', function(event){
        if(event.shiftKey){
            event.preventDefault();
        }
        if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9){}
        else{
            if(event.keyCode < 95){
                if(event.keyCode < 48 || event.keyCode > 57){
                    event.preventDefault();
                }
            }
            else{
                if(event.keyCode < 96 || event.keyCode > 105){
                    event.preventDefault();
                }
            }
        }
    });

});

// Bootstrap input-spinner
$(function(){
    $('.spinner .btn:first-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('max') == undefined || parseInt(input.val()) < parseInt(input.attr('max'))) {    
            input.val(parseInt(input.val(), 10) + 1);
        } else {
            btn.next("disabled", true);
        }
    });
    $('.spinner .btn:last-of-type').on('click', function() {
        var btn = $(this);
        var input = btn.closest('.spinner').find('input');
        if (input.attr('min') == undefined || parseInt(input.val()) > parseInt(input.attr('min'))) {    
            input.val(parseInt(input.val(), 10) - 1);
        } else {
            btn.prev("disabled", true);
        }
    });
})

//Resalta los campos que no cumplen con la validacion basica
//1. campos vacios
//2. 1 <= N <= 100
function runInputValidation() {
    var error = 0;
    $('#frmCube input:text').each(function(){
        if(!$(this).val().length) {
            $(this).parent('div').addClass('has-error');
            error = 1; //campo vacio
        }
        else if($(this).attr('id') === 'cubeDimensions') {
            if(parseInt($(this).val()) < 1 || parseInt($(this).val()) > 100) {
                error = 2; //el valor de las dimensiones del cubo no está entre 1 y 100
            }
        }
    });
    
    switch(error) {
        case 1:
            showAlert('Campos vacíos');
            break;
        case 2:
            showAlert('<strong>Cube dimensions:</strong> debe ser un valor entre 1 y 100');
            break;
    }

    if(error) {
        return false;
    }

    return true;
}

// Restaura el aspecto gráfico de los campos cuando pasan la validacion
function resetInputValidation() {
    $('#frmCube input:text').each(function(){
        $(this).parent('div').removeClass('has-error');
    });
    closeAlert();
}

function showAlert(msg) {
    $('#alertMsg').show().find('span').html(msg).focus();
    focusElement('#alertMsg');
}

// Cerrar mensaje de alerta
function closeAlert() {
    $('#alertMsg').hide();
}

//Hace focus en cualquier elemento del HTML
function focusElement(id) {
    var scrollPos = $(id).offset().top;
    $(window).scrollTop(scrollPos);
}