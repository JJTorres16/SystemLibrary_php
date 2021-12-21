<?php

require_once ('models/ModeloCatalogo.php');
require_once ('modelDAO/CatalogoDAO.php');

class Catalogo extends Controller {

    function __construct(){
        
        parent::__construct();
        //$this->view->mensaje = "Sección principal";
        //$this->view->render('catalogo/index');
        //echo "<p>Nuevo controlador main</p>";
    }

    function irVistaMain(){
        $this->view->render('catalogo/index');
    }

    function irVistaAdd(){
        $this->view->render('catalogo/add');
    }

    function irVistaEdit(){
        $this->view->render('catalogo/edit');
    }

    function Agregar(){
        $modelCat = new ModeloCatalogo();
        $catDAO = new CatalogoDAO();
        $countEmptys = 0;
        
        //Variables del nuevo libro
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nameBook = $_POST['txtNameBook'];
            $nameAuthor = $_POST['txtAuthorBook'];
            $ISBN = $_POST['txtISBNBook'];
            $format = $_POST['txtFormatSelect'];
            $lengauge = $_POST['txtLenguageBook'];
            $edition = $_POST['txtEditionBook'];
            $year = $_POST['txtYearBook'];
            $category = $_POST['txtCategoryBook'];
            $totalPages = $_POST['txtPagesBook'];
            $quantity = $_POST['txtTotalBook'];
            $sinopsis = $_POST['txtAreaSinposis'];
            $editorial = $_POST['txtEditorialBook'];
            
            // Lectura de la imagen
            $coverName = $_FILES['fileImageBook']['name'];
            $coverType = $_FILES['fileImageBook']['type'];
            $coverSize = $_FILES['fileImageBook']['size'];
            $coverRute = $_FILES['fileImageBook']['tmp_name'];
            
            // Proceso par guardar la ruta:
            $rute = 'public/imgs/'.$coverName;
            move_uploaded_file($coverRute, $rute); // Movemos la imagen al fichero /public/imgs

            //En el objeto $modelCat insertamos los valores que se han recibido desde el formulario:
            $modelCat->setNombre($nameBook);
            $modelCat->setAutor($nameAuthor);
            $modelCat->setISBN($ISBN);
            $modelCat->setFormato($format);
            $modelCat->setIdioma($lengauge);
            $modelCat->setEdicion($edition);
            $modelCat->setAnio($year);
            $modelCat->setCategoria($category);
            $modelCat->setPaginas($totalPages);
            $modelCat->setCantidad($quantity);
            $modelCat->setSinopsis($sinopsis);
            $modelCat->setEditorial($editorial);
            $modelCat->setPortada($rute);
            
            //Se pasa el nuevo objeto al objeto DAO para ejecutar la función:
            $catDAO->add($modelCat);

            header('Location: /SystemLibrary/catalogo');
        }
        
        //$this->view->render('catalogo/index');
    }

    function showAll(){

        $listaCatalogo = array();
        $catalogoDAO = new CatalogoDAO();

        $queryCatalogo = $catalogoDAO->show();

        foreach($queryCatalogo as $row){
            $modelCat = new ModeloCatalogo();
            $modelCat->setidLibros($row['idlibros']);
            $modelCat->setNombre($row['nombre']);
            $modelCat->setAutor($row['autor']);
            $modelCat->setFormato($row['formato']);
            $modelCat->setIdioma($row['idioma']);
            $modelCat->setEdicion($row['edicion']);
            $modelCat->setAnio($row['anio']);
            $modelCat->setCategoria($row['categoria']);
            $modelCat->setPaginas($row['nopaginas']);
            $modelCat->setCantidad($row['cantidad']);
            $modelCat->setSinopsis($row['sinopsis']);
            $modelCat->setEditorial($row['editorial']);
            $modelCat->setPortada($row['portada']);
            array_push($listaCatalogo, $modelCat);
        }

        return $listaCatalogo;
    }
}

?>