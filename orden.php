<?=plantillaHeader('Carrito')?>

<div class="container">
    <h1 class="display-3">
        Carrito de Compras
    </h1>
    <form>
        <table>
            <thead>
                <td colspan="2">Producto</td>
                <td>Precio</td>
                <td>Cantidad</td>
                <td>Total</td>
            </thead>
            <tbody>
                <?php if(empty($producto)):?>
                    <tr>
                        <td colspan="5"><p>No tiene Articulos registrados en el Carrito de Compras</p></td>
                    </tr>
                    <?php endif;?>
            </tbody>
        </table>
    </form>
</div>