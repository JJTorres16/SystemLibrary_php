function muestraErrorAltaPrestamo(numError){

    if(numError == 10){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El alumno no está registrado en la base de datos'
        })

    } else if(numError == 11){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El alumno no puede pedir otro libro porque tiene dos préstamos en curso'
        })

    } else if (numError == 12){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El alumno no puede pedir el mismo libro dos veces al mismo tiempo'
        })

    } else if(numError == 0){
        Swal.fire({
            icon: 'success',
            title: 'Préstamo nuevo',
            text: 'El préstamo ha sido registrado con éxito',
            showConfrimButton: false,
            timer: 500      
        })

        window.location.href = '/SystemLibrary/catalogo'

    }
}