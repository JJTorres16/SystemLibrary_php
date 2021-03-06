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

    function agregar(){
        $modelCat = new ModeloCatalogo();
        $catDAO = new CatalogoDAO();

        if(isset($_GET['categoria']))
            $categoria = $_GET['categoria'];
        else
            $categoria = 0;

        if(isset($_GET['pag']))
            $pag = $_GET['pag'];
        else
            $pag = 0;
        
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
        }

        header('Location: /SystemLibrary/catalogo?categoria='.$categoria.'&pag='.$pag);
        
        //$this->view->render('catalogo/index');
    }

    function showAll(){

        $listaCatalogo = array();
        $catalogoDAO = new CatalogoDAO();

        if(isset($_GET['busqueda']))
            $busqueda = $_GET['busqueda'];
        else
            $busqueda = "";

        if(isset($_GET['categoria']))
            $categoria = $_GET['categoria'];
        else
            $categoria = "";

        if(isset($_GET['pag'])) {
            $pag = $_GET['pag'];
            if ($pag < 0)
                $pag = 0;

        } else
            $pag = 0;

        //Establecer el límte y el offset
        $offset = (($pag)*9);
        $limite = $offset + 9;

        $queryCatalogo = $catalogoDAO->show($busqueda, $categoria, $offset, $limite);

        foreach($queryCatalogo as $row){
            $modelCat = new ModeloCatalogo();
            $modelCat->setidLibros($row['idlibros']);
            $modelCat->setISBN($row['isbn']);
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

    function showDetail($id){

        $listaCatalogo = array();
        $catalogoDAO = new CatalogoDAO();
        $queyLibro = $catalogoDAO -> showDetail($id);

        // Se empiza a llenar el objeto con la información del libro:
        foreach($queyLibro as $row){
            $modeloLibro = new ModeloCatalogo();
            $modeloLibro -> setidLibros($row['idlibros']);
            $modeloLibro->setISBN($row['isbn']);
            $modeloLibro -> setNombre($row['nombre']);
            $modeloLibro -> setAutor($row['autor']);
            $modeloLibro -> setFormato($row['formato']);
            $modeloLibro -> setIdioma($row['idioma']);
            $modeloLibro -> setEdicion($row['edicion']);
            $modeloLibro -> setAnio($row['anio']);
            $modeloLibro -> setCategoria($row['categoria']);
            $modeloLibro -> setPaginas($row['nopaginas']);
            $modeloLibro -> setCantidad($row['cantidad']);
            $modeloLibro -> setSinopsis($row['sinopsis']);
            $modeloLibro -> setEditorial($row['editorial']);
            $modeloLibro -> setPortada($row['portada']);
            array_push($listaCatalogo, $modeloLibro);
        }

        return $listaCatalogo;
    }

    function editar(){

        $modeloCatalogo = new ModeloCatalogo();
        $catalogoDAO = new CatalogoDAO();

        if(isset($_GET['categoria']))
            $categoria = $_GET['categoria'];
        else
            $categoria = 0;

        if(isset($_GET['pag']))
            $pag = $_GET['pag'];
        else
            $pag = 0;

        // Si se ha realizado un mehtdo POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idLibro = $_POST['txtIdLibro'];
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
            $coverName = $_FILES['fileImageBook']['name'];

            //Lectura de la imagen:
            if($coverName != ""){

                echo "Si entreó aquí";

                // Lectura de la imagen
                $coverType = $_FILES['fileImageBook']['type'];
                $coverSize = $_FILES['fileImageBook']['size'];
                $coverRute = $_FILES['fileImageBook']['tmp_name'];
                    
                // Proceso par guardar la ruta:
                $rute = 'public/imgs/'.$coverName;
                move_uploaded_file($coverRute, $rute); // Movemos la imagen al fichero /public/imgs    

                $modeloCatalogo -> setPortada($rute);

            } else {
                $inputCover = "";

            }

            $modeloCatalogo->setidLibros($idLibro);
            $modeloCatalogo->setNombre($nameBook);
            $modeloCatalogo->setAutor($nameAuthor);
            $modeloCatalogo->setISBN($ISBN);
            $modeloCatalogo->setFormato($format);
            $modeloCatalogo->setIdioma($lengauge);
            $modeloCatalogo->setEdicion($edition);
            $modeloCatalogo->setAnio($year);
            $modeloCatalogo->setCategoria($category);
            $modeloCatalogo->setPaginas($totalPages);
            $modeloCatalogo->setCantidad($quantity);
            $modeloCatalogo->setSinopsis($sinopsis);
            $modeloCatalogo->setEditorial($editorial);

             // Se manda al objeto DAO para ejecutar la función de UPDATE:
            $catalogoDAO -> edit($modeloCatalogo);
            }

            header('Location: /SystemLibrary/catalogo?categoria='.$categoria.'&pag='.$pag);

    }

    function eliminar(){

        if(isset($_GET['categoria']))
            $categoria = $_GET['categoria'];
        else
            $categoria = 0;

        if(isset($_GET['pag']))
            $pag = $_GET['pag'];
        else
            $pag = 0;

        $modeloCatalogo = new ModeloCatalogo();
        $catalogoDAO = new CatalogoDAO();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $idLibro = $_POST['txtIdLibro'];

            // Se ejecuta el modelo DAO de catálogo para eliminar el libro seleccionado:
            $catalogoDAO ->delete($idLibro);

        }

        header('Location: /SystemLibrary/catalogo?categoria='.$categoria.'&pag='.$pag);
    }


    function setCantPaginas(){

        if(isset($_GET['categoria']))
            $idCategoria = $_GET['categoria'];
        else
            $idCategoria = 0;
           
        if(isset($_GET['busqueda']))
            $busqueda = $_GET['busqueda'];
        else
            $busqueda = "";

        $catalogoDAO = new CatalogoDAO();
        $modeloCatalogo = new ModeloCatalogo();

        $queryTotalLibros = $catalogoDAO->totalLibros($idCategoria, $busqueda);

        foreach($queryTotalLibros as $cant)
            $totalLibros = $cant['count'];

        $totalPaginas = $modeloCatalogo->totalPaginas($totalLibros);

        return  $totalPaginas;
         
    }
}

?>