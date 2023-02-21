<?php
//Añadir al carrito
include './controller/funciones.php';
if(isset($_POST['id'], $_POST['cantidad'])&& is_numeric($_POST['id'])&& is_numeric($_POST['cantidad'])){
    $producto = (int)$_POST['id'];
    $cantidad = (int)$_POST['cantidad'];
    $stmt = $con->prepare('SELECT * FROM producto WHERE id = ?,');
    $stmt->execute([$_POST['id']]);
    $pr=$stmt->fetch(PDO:: FETCH_ASSOC);
    if($producto && $cantidad >0){
        if(isset($_SESSION['orden'])&& is_array($_SESSION['orden'])){
            if(array_key_exists($producto, $_SESSION['orden'])){
                //actualizar carrito existente
                $_SESSION['orden'][$producto] += $cantidad;
            }else{
                //crear carrito
                $_SESSION['orden'][$producto] += $cantidad;

            }
        }else{
            //cuando el producto no esta en el carrito
            $_SESSION['orden'] = array($producto=>$cantidad);

        }
    }
    header('location:index.php?pagina=carrito');
exit;
}
//eliminar del carrito
if(isset($_GET['eliminar'])&& is_numeric($_GET['eliminar']) &&
isset($_SESSION['orden']) && isset($_SESSION['orden'][$_GET['eliminar']])){
unset($_SESSION['orden'][$_GET['eliminar']]);
}
//actualizar carrito
if(isset($_POST['actualizar'])&& isset($_SESSION['orden'])){
foreach($_POST as $k = $v){
    if(strpos($k,'cantidad') !== false && is_numeric($v)){
$id = str_replace('cantidad-','',$k);
$cantidad = (int)$v;
if(is_numeric($id)&& isset($_SESSION['orden'])&& $cantidad > 0){
$_SESSION['orden'][$id]= $cantidad;
}
}
}
header('Location: index.php?pagina=carrito');
exit;
}
//Comprar 
if(isset($_POST['orden']) && isset($_SESSION['orden']) && !empty($_SESSION['orden'])){
    header('Location: index.php?pagina=comprar');
}
$productoscarrito = isset($_SESSION['orden']) ? $_SESSION['orden'] : array();
$orden=array();
$subtotal= 0.00;
if($productoscarrito){
$arregloasigno = implode(',', array_fill(0, count($productoscarrito),'?'));
$stmt = $con->prepare('SELECT * FROM productos WHERE id IN('.$arregloasigno');');
$stmt->execute(array_keys($productoscarrito));
$pr = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($pr as $productos){
    $subtotal += (float)$productos['preciov']* (int)$productoscarrito[$productos['id']];
}
}
?>