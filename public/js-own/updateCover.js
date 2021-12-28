
// El id del input file de nuestra imagen nueva de portada:
const $seleccionaArchvivos = document.querySelector("#fileImageBook");
var form = document.getElementsByName("txtidLibro");

// Cuando la información dentro del campo cambie:
$seleccionaArchvivos.addEventListener("change", () => {
    // Se pueden seleccionar varios archivos:
    const archivos = $seleccionaArchvivos.files;
    // Si no hay archivo se sale de la función
    if (!archivos || !archivos.length){
        return;
    }

    form[0].submit();

});

