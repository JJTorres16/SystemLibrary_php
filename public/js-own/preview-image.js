// Obtener referencia al input y a la imagen
const $seleccionaArchvivos = document.querySelector("#fileImageBook");
const wrapper = document.querySelector(".wrapper");
$imagePreview = document.querySelector("#imgPortadaLibro");

// Cuando el campo cambie:
$seleccionaArchvivos.addEventListener("change", () =>{
    // Se pueden seleccionar más de un archivos
    const archivos = $seleccionaArchvivos.files;
    // Si no hay archivo se sale de la función y se quita la imagen:
    if(!archivos || !archivos.length){
        $imagePreview.src = "";
        return;
    }

    //Quitamos el borde del wrapper:
    if (wrapper != null)
        wrapper.classList.add("active");
    // Se toma el primer archivo:
    const primerArchivo = archivos[0];
    // Se convierte a objeto URL
    const objecttURL = URL.createObjectURL(primerArchivo);
    // A la fuente de la etiqueta imagen se le coloca el objeto URL
    $imagePreview.src = objecttURL;
});