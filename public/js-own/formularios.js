
// Funciones relacionadas al CRUD de libros:

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


// Funciones relacionadas al CRUD de alumnos:

function confirmaAltaAlumno(form){

    nombreAlumno = document.getElementById("txtNameAlumno").value;
    apPaternoAlumno = document.getElementById("txtPaternoAlumno").value;
    apMaternoAlumno = document.getElementById("txtMaternoAlumno").value;
    noControl = document.getElementById("txtNCAlumno").value;
    carrera = document.getElementById("txtCarreraAlumno").value;
    email = document.getElementById("txtEmailAlumno").value;

    // Generamos el nombre completo del alumno:
    nombreCompleto = nombreAlumno + " " + apMaternoAlumno + " " + apMaternoAlumno;

    swal({
        title: "¿Seguro que quieres dar de alta al alumno " + nombreCompleto + "?",
        text: "Número de Control: " + noControl + "\nCarrera: " + carrera + "\nEmail: " + email,
        icon:"info",
        buttons: true,
    })
    .then((isOkay) => {
        if(isOkay){
            swal("¡Nuevo alumno dado de alta!", {
                icon: "success",
            });
            document.formAltaAlumno.submit();
            return true;
        } 
    });
    return false;
}

function confirmaBajaLogicaAlumnos(form){

    nombre = document.getElementById("txtNombreAlumno").value;
    apPaterno = document.getElementById("txtApPaterno").value;
    apMaterno = document.getElementById("txtApMaterno").value;

    nombreCompleto = apPaterno + " " + apMaterno + " " + nombre;

    swal({
        title: "¿Seguro que quieres dar de baja al siguiente alumno/a?",
        text: "Nombre completo: " + nombreCompleto,
        icon:"warning",
        buttons: true,
        dangerMode: true,
    })
    .then((isOkay) => {
        if(isOkay){
            swal("¡El alumno ha sido dado de baja", {
                icon: "success",
            });
            document.formBajaAlumno.submit();
            return true;
        } 
    });
    return false;
}

function confirmaCambiosAlumno(form){

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
            document.formEditAlumno.submit();
            return true;
        } 
    });
    return false;
}

