<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Préstamos</title>
</head>
<body>
    <?php require_once 'views/header.php' ?>

    <div class="container" style="margin-top:50px;">
        <h2>Registro de Préstamos</h2>
        <small class="text-muted">Historial de préstamos actuales y vencidos</small>    
    </div><br>

    <div class="container">
        <label for="" class="form-label">Filtra por:</label>
        <div class="row g-3">
            <div class="col-md-2">
                <select name="selectFiltroPrestamos" id="selectFiltroPrestamos" class="form-select">
                    <option value="alumno">Alumno</option>
                    <option value="libro">Libro</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="txtDatoFiltro" name="txtDatoFiltro" placeholder="No. de control de alumno o nombre del libro">
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:25px">
        <h5> <small class="text-muted"> Seleccione el tipo de registro que desea consultar </small> </h5>
    </div>

    <div class="container" style="margin-top:15px">
        <div class="accordion" id="accordionPrestamos">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headerEnCurso">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#prestamosEnCurso" aria-expanded="true" aria-controls="prestamosEnCurso">
                        Préstamos en curso
                    </button>
                </h2>
                <div id="prestamosEnCurso" class="accordion-collapse collapse" arial-labelledby="headerEnCurso" data-bs-parent="#accordionPrestamos">
                    <div class="container" style="margin-top:25px;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Id</th>
                                    <th scope="col" width="30%">Libro</th>
                                    <th scope="col" width="22%">Alumno</th>
                                    <th scope="col" width="12%">Fec. Inicio</th>
                                    <th scope="col" width="12%">Fec. Entrega</th>
                                    <th scope="col" width="12%">Refrendar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Túneles</td>
                                    <td>Jesús Julián Torres Velásquez</td>
                                    <td>12-12-2021</td>
                                    <td>15-12-2021</td>
                                    <td>
                                        <!-- Código para deshabilitar un link -->
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                            <a href="alumno/edit" class="btn btn-outline-success btn-sm" style="cursor: not-allowed; pointer-events: none;">Refrendar</a>
                                        </span>
                                    </td>   
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Fundametos de programación orientada a objetos</td>
                                    <td>Samantha Vianey Jiménez Palacios</td>
                                    <td>12-12-2021</td>
                                    <td>15-12-2021</td>
                                    <td>
                                        <a href="alumno/edit" class="btn btn-outline-success btn-sm">Refrendar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headerHistorial">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#prestamosHistorial" aria-expanded="true" aria-controls="prestamosHistorial">
                        Historial de préstamos
                    </button>
                </h2>
                <div id="prestamosHistorial" class="accordion-collapse collapse" arial-labelledby="headerHistorial" data-bs-parent="#accordionPrestamos">
                    <div class="container" style="margin-top:25px;">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">Id</th>
                                    <th scope="col" width="30%">Libro</th>
                                    <th scope="col" width="22%">Alumno</th>
                                    <th scope="col" width="12%">Fec. Inicio</th>
                                    <th scope="col" width="12%">Fec. Entrega</th>
                                    <th scope="col" width="12%">Refrendar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Túneles</td>
                                    <td>Jesús Julián Torres Velásquez</td>
                                    <td>12-12-2021</td>
                                    <td>15-12-2021</td>
                                    <td>
                                        <!-- Código para deshabilitar un link -->
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                            <a href="alumno/edit" class="btn btn-outline-success btn-sm" style="cursor: not-allowed; pointer-events: none;">Refrendar</a>
                                        </span>
                                    </td>   
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Fundametos de programación orientada a objetos</td>
                                    <td>Samantha Vianey Jiménez Palacios</td>
                                    <td>12-12-2021</td>
                                    <td>15-12-2021</td>
                                    <td>
                                        <a href="alumno/edit" class="btn btn-outline-success btn-sm">Refrendar</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>        
        </div>
    </div>
             
    <?php //require_once 'views/footer.php' ?>
</body>
</html>