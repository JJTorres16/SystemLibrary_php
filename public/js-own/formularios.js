
function confirmaIngreso(form){

    libro = document.getElementById("txtNameBook").value;
    autor = document.getElementById("txtAuthorBook").value;
    anio = document.getElementById("txtYearBook").value;
    isbn = document.getElementById("txtISBNBook").value;
    editorial = document.getElementById("txtEditorialBook").value;

    /*action = confirm("¿Estás seguro de querer agregar el libro " + libro + " al stock?");

    if(action)
        document.formAltaLibro.submit();
    else
        e.preventDefault();*/

    swal({
        title: "¿Seguro que quieres agregar el libro " + libro + " al stock?",
        text: "Autor: " + autor + "\nAño: " + anio + "\nISBN: " + isbn + "\nEditorial: " + editorial,
        icon:"warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isOkay) => {
        if(isOkay){
            document.formAltaLibro.submit();
            return true;
        } 
    });
    return false;
}

//Will tiene una afición muy extraña para un chico de catorce años: pasa su tiempo excavando, buscando tesoros perdidos en las entrañas de la tierra. Así descubre que, bajo el mismo Londres, existen lugares desconocidos, túneles que constan en ningún mapa y puertas olvidadas durante siglos. Pero... ¿adónde llevan?/*