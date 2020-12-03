<?php
/* funcion para cargar la pagina */
function CargarPagina($page)
{
    if (isset($_GET["page"])) {
        $modulo =$_GET["page"] . ".php";       
        if (file_exists($modulo)) {
            $page = $_GET["page"];
        } else {
            $page = "404";
        }
    } else {
        $page = "inicio";
    }
    return include($page . ".php");    
}

/* funcion mensaje de error contacto */
function MostrarMensaje($rta)
{
    switch ($rta) {
        case '0x001':
            $mensaje = "El nombre ingresado no es valido";            
            break;
        case '0x002':
            $mensaje = "El email ingresado no es valido";
            break;
        case '0x003':
            $mensaje = "El mensaje ingresado no es valido";
            break;
        case '0x004':
            $mensaje = "La consulta fue enviada";
            break;
        case '0x005':
            $mensaje = "La consulta NO fue enviada";
            break;
    }    
    return "<p class='rta rta-". $rta . "'>" . $mensaje . "</p>";
}

/*funcion para Mostrar Productos*/

function MostrarProductos()
{    
    $archivo = fopen("listadoProductos.csv", 'r');
    if ($archivo) {
        while ($datos = fgetcsv($archivo, 1000)) {
            ?>
            <div class="product-grid">
                <div class="content_box">
                    <a href="index.php?page=producto">
                        <div class="left-grid-view grid-view-left">
                            <img src="images/productos/<?php echo $datos[0]; ?>.jpg" class="img-responsive watch-right" alt=""/>
                        </div>
                    </a>
                    <h4><a href="#"><?php echo $datos[4] . " ". $datos[1] . " ". $datos[5]; ?></a></h4>
                    <p>Stock: <?php echo $datos[3]; ?></p>
                    <span>$<?php echo $datos[2]; ?></span>
                </div>
            </div>
            <?php
        }
    } else {
        echo "El archivo No se abrio";
    }
    fclose($archivo);
}

// funcion para registrar un nuevo cliente
function RegistroCliente($pdo, $nombre, $apellido, $email, $pass)
{
    // Validar conexion por metodo POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recolexion de variables
        $nombre = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : null;
        $apellido = isset($_REQUEST['apellido']) ? $_REQUEST['apellido'] : null;
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
        $pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
        $date = new DateTime('', new DateTimeZone('America/Tegucigalpa'));
        $dateSignon = $date -> format('Y-m-d');
        echo $dateSignon;

        // Preparacion de la consulta
        $query = 'INSERT INTO val_clientes (nombre, apellido, email, password, val_hash, date_signon) VALUES (:nombre, :apellido, :email, :password, :val_hash, :date_signon)';
    }
}