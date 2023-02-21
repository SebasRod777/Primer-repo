<?php
    session_start();
    include './controller/funciones.php';
    $con = conexion();
    $pagina= isset($_GET['pagina']) && file_exists($_GET['pagina'].'.php')? $_GET['pagina']:'home';
    include $pagina.'.php';
?>