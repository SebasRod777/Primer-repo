<?php
    $limite = 2;
    $paginaactual = isset($_GET['p']) && is_numeric($_GET['p']) ? 
    (int)$_GET['p']: 1;
    $stmt = $con->prepare('SELECT * FROM productos ORDER BY fecha_agregado DESC LIMIT ?,?;');
    $stmt->bindValue(1,($paginaactual-1) * $limite, PDO::PARAM_INT);
    $stmt->bindValue(2, $limite, PDO::PARAM_INT);
    $stmt->execute();
    $pr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalarticulos = $con->query('SELECT * FROM productos;')->rowCount();

?>
<?=plantillaHeader('Producto') ?>
<div class="container">
    <h1 class="display-3"></h1>
    <p><?php echo $totalarticulos?> Productos disponibles</p>
    <hr>
    <div class="container productos">
        <form action="./controller/carrito.php" method="POST">
            <div class="container">
                <div class="row justify-content-center">
        <?php
            foreach ($pr as $productos):
        ?>
        <div class="card mb-3" style="max-width:auto;">
  <div class="row g-0">
    <div class="col-5">
    <img src="./<?php echo $productos['img']?>" class="card img-fluid mx-auto mt-4" style="width:300px;height: 300px;" alt="">
    </div>
    <div class="col-7">
      <div class="card-body bg-light">
      <div class="text-center">
                        <a href="index.php?pagina=producto&id=<?php echo $productos['id']?>" class="producto">
                        <button type="button" class="btn btn-outline-warning"><span class="nombreproducto"><?php echo $productos['nombre'] ?></span></button>
                        </a><br>
                        <span class="nombreproducto fs-3"><?php echo "Descripcion: ".$productos['desc']?></span>
                            <span class="nombreproducto fs-4"><?php echo "Precio: $".$productos['preciov'] ?></span>
                            <span class="nombreproducto fs-4"><?php echo "<br>Cantidad: ".$productos['cantidad'] ?></span>
                        <br>
                        <div class="d-grid gap-2">
                        <button class="btn btn-warning mt-2" type="button"><i class="bi bi-shop "></i> Ver más </button>
                        <button class="btn btn-success mt-2" type="button"><i class="bi bi-cart-plus "></i> Añadir carrito </button>
                </div>
            <div>
      </div>
    </div>
  </div>
</div>
        </div>
        </div>
        </form>
        <?php endforeach; ?>
    </div>
</div>
    <div class="botones container text-center">
        <ul class="pagination justify-content-center">
            <?php if ($paginaactual>1):?>
            <li class="page-item"><a href="index.php?pagina=producto&p=<?php echo $paginaactual-1?>" class="page-link">  Anterior</a></li>
            <?php endif;?>
        <?php if ($totalarticulos>($paginaactual*$limite)-$limite + count($pr)):?>
            <li class="page-item"> <a href="index.php?pagina=producto&p=<?php echo $paginaactual+1?>" class="page-link"> Siguiente</a></li>
            <?php endif;?>
        </ul>            
    </div>
</div>
<?=plantillaFooter() ?>