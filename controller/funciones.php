<?php
    function conexion(){
        $usuario= 'root';
        $servidor= 'localhost';
        $password='';
        $database='carritodbd';

        try{
            return new PDO('mysql:host='.$servidor.'; dbname='.$database.'; charset=UTF8;',$usuario, $password);
            
        } catch(PDOException $e){
            exit('Error de conexion de la base de datos'.$e);
        }
    } conexion();

    function plantillaHeader($titulo){
echo <<<EOT
        <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <title>$titulo</title>
                    <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="./libs/bootstrap-icons.css" rel="stylesheet">
                    <script src="./js/jquery-3.6.1.min.js"></script>
                </head>
                <body>
                    <header>
                        <nav class="navbar p-3 navbar-expand-sm navbar-light bg-light">
                        <div class="container-fluid">
                        <a class="navbar-brand"><h1>Sistema de carrito de compras <i class="bi bi-paypal"> </i></h1></a>
                            <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.php?pagina=producto">Productos</a></li>
                            
                            </ul>
                            <button type="button" class="btn m-3 btn-outline-secondary position-relative">
                            <i class="bi bi-cart"></i>
                            <span class="badge rounded-pill bg-primary position-absolute top-0 start-100 translate-middle">
                            0
                            </span>
                            </button>
                            </div>
                        </nav>
                    </header>
                <main>
                
EOT;
    }

    function plantillaFooter(){
        $year = date('Y');
echo <<<EOT
    </main>
    <hr><footer class="text-center">
        <div class="container-fluid">
            <p>&copy; $year, Sistema de carrito de compras</p>
        </div>
    </footer>
    </body>
    </html>
EOT;
    }
?>