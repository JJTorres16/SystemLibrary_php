
function confirmaIngreso(form){

    libro = document.getElementById("txtNameBook").value;
    autor = document.getElementById("txtAuthorBook").value;
    anio = document.getElementById("txtYearBook").value;
    isbn = document.getElementById("txtISBNBook").value;
    editorial = document.getElementById("txtEditorialBook").value;

    swal({
        title: "¿Seguro que quieres agregar el libro " + libro + " al stock?",
        text: "Autor: " + autor + "\nAño: " + anio + "\nISBN: " + isbn + "\nEditorial: " + editorial,
        icon:"info",
        buttons: true,
    })
    .then((isOkay) => {
        if(isOkay){
            swal("¡El libro se ha añadido al stock!", {
                icon: "success",
            });
            document.formAltaLibro.submit();
            return true;
        } 
    });
    return false;
}

function confirmaBajaLogica(form){

    libro = document.getElementById("txtNameBook").value;

    swal({
        title: "¿Seguro que quieres dar de baja el libro " + libro + "?",
        icon:"warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isOkay) => {
        if(isOkay){
            swal("¡El libro se ha eliminado!", {
                icon: "success",
            });
            document.formBajaLibro.submit();
            return true;
        } 
    });
    return false;
}


function confirmaCambios(form){

    libro = document.getElementById("txtNameBook").value;

    swal({
        title: "¿Seguro que quieres guardar los cambios?",
        icon:"info",
        buttons: true,
        //dangerMode: false,
    })
    .then((isOkay) => {
        if(isOkay){
            swal("¡Los cambios se han guardado", {
                icon: "success",
            });
            document.formCambioLibro.submit();
            return true;
        } 
    });
    return false;
}


