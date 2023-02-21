<?php
    if(isset($_GET['id'])){
        $stmt=$con->prepare('SELECT * FROM producto WHERE id =?;');
        $stmt=execute([$_GET['id']]);
        $pr = $stmt ->fetch(PDO:: FETCH_ASSOC);
        if(!$pr){
            exit('El producto solicitado no esta disponible');
        }else{
            exit('El identificador no ha sido seleccionado');
        };
    };
?>
<?=plantillaHeader('Prodcuto: ')?>
<div class="productox container">
    <img src="<?=$pr['img'] ?>">
    <div>
<!--descripcion del producto-->
</div>
<form>
<input type="number" name="cantidad" id="cantidad" value="1" min="1" max="<?=$pr['cantidad']?>">
<input type="submit" value="Añadir al carrito">
</form>
</div>
<?=plantillaFooter()?>