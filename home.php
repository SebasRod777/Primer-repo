<?php
//Traer los 4 productos más recientes
    $stmt = $con->prepare('SELECT * FROM productos ORDER BY fecha_agregado DESC LIMIT 4;');
    $stmt->execute();
    $pr= $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?= plantillaHeader('Home')?>
<div class="container">
<div class="jumbotron-fluid text-center">
    <h1 class="display-3">Articulos</h1>
    <p class="lead">Escenciales para vida diaria!</p>
</div>
<div class="text-center">
    <h2> Productos agregados recientemente:</h2>
    <div class="container productos">
        <form action="./controller/carrito.php" method="POST">
            <div class="container">
                <div class="row justify-content-center">
        <?php
            foreach ($pr as $productos):
        ?>
        <div class="col-3">
            <div class="card text-blank bg-light" style="height:590px; width: 310px;">
                    <img src="./<?php echo $productos['img']?>" class="card-img-top mx-auto mt-4" style="width:300px;height: 300px;" alt="">
                <hr><div class="card-body">
                    <div class="text-center">
                        <a href="index.php?pagina=producto&id=<?php echo $productos['id']?>" class="producto">
                        <button type="button" class="btn btn-outline-warning"><span class="nombreproducto"><?php echo $productos['nombre'] ?></span></button>
                        </a><br>
                            <span class="nombreproducto"><?php echo "Precio: $".$productos['preciov'] ?></span>
                            <span class="nombreproducto"><?php echo "<br>Cantidad: ".$productos['cantidad'] ?></span>
                        <br>
                        <div class="d-grid gap-2">
                        <button class="btn btn-warning mt-2" type="button"><i class="bi bi-shop "></i> Ver producto </button>
                        <button class="btn btn-success mt-2" type="button"><i class="bi bi-cart-plus "></i> Añadir carrito </button>
                </div>
            <div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </form>
        <?php endforeach; ?>
        
    </div>
</div></div>
<?= plantillaFooter()?>