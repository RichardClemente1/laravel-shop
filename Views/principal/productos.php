<?php include "Views/template/header.php"; ?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="<?php echo BASE_URL; ?>public/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Nuestros Productos</h2>
                    <div class="breadcrumb__option">
                        <a href="<?php echo BASE_URL; ?>">Inicio</a>
                        <span>Productos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categorias</h4>
                        <ul>
                            <?php foreach ($data['categorias'] as $categoria) { ?>
                                <li>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="categorias" name="categorias[]" id="<?php echo $categoria['id']; ?>" value="<?php echo $categoria['id']; ?>">
                                        <label for="<?php echo $categoria['id']; ?>" class="form-check-label"><?php echo $categoria['categoria']; ?></label>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="<?php echo (empty($data['minimo']['total'])) ? 0 : round($data['minimo']['total'], 0); ?>" data-max="<?php echo (empty($data['maximo']['total'])) ? 1 : round($data['maximo']['total'], 0); ?>">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="row" id="content-productos">
                    <?php foreach ($data['productos'] as $producto) { ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mix cat_<?php echo $producto['id_categoria']; ?> fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="<?php echo BASE_URL . 'public/img/productos/' . $producto['imagen']; ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="https://api.whatsapp.com/send?phone=<?php echo $data['negocio']['whatsapp'] . '&text=Productos= ' . $producto['nombre'] . ' Precio(' . $producto['precio'] . ')' ; ?>"  target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                        <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                        <li><a href="#" stock="<?php echo $producto['cantidad']; ?>" class="producto-agregar" id="<?php echo $producto['id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?php echo $producto['nombre']; ?></a></h6>
                                    <h5>$<?php echo $producto['precio']; ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="product__pagination" id="content-page">
                    <?php
                    $anterior = $data['pagina'] - 1;
                    $siguiente = $data['pagina'] + 1;
                    $url = BASE_URL . 'principal/productos/';
                    if ($data['pagina'] > 1) {
                        echo '<a href="' . $url . $anterior . '"><i class="fa fa-long-arrow-left"></i></a>';
                    }
                    if ($data['total'] >= $siguiente) {
                        echo '<a href="' . $url . $siguiente . '"><i class="fa fa-long-arrow-right"></i></a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php include "Views/template/footer.php"; ?>

<script src="<?php echo BASE_URL; ?>public/js/cart.js"></script>
<script>
    
    const categorias = document.querySelectorAll('.categorias');
    const minamount = document.getElementById("minamount");
    const maxamount = document.getElementById("maxamount");
    const contentproductos = document.querySelector('#content-productos');
    const contentpage = document.querySelector('#content-page');
    //filtro por categorias
    categorias.forEach(function(checkbox) {
        checkbox.addEventListener("click", function() {
            var minSelectedPrice = minamount.value.toString().replace('$', '');
            var maxSelectedPrice = maxamount.value.toString().replace('$', '');
            const precios = minSelectedPrice + ';' + maxSelectedPrice;
            handleCheckboxClick(precios);
        });
    });

    function handleCheckboxClick(precios) {
        const selectedCategories = [];
        categorias.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.value);
            }
        });

        const url = ruta + "principal/filtro";
        let data = new FormData();
        data.append('categorias', selectedCategories);
        data.append('precios', precios);
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                html = '';
                res.productos.forEach(producto => {
                    html += `<div class="col-lg-3 col-md-4 col-sm-6 mix cat_${producto.id_categoria} fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="${ ruta + 'public/img/productos/' + producto.imagen }">
                            <ul class="featured__item__pic__hover">
                                <li><a href="https://api.whatsapp.com/send?phone=${ res.negocio.whatsapp + '&text=Productos= ' + producto.nombre +  ' Precio(' + producto.precio + ')' }" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                                <!-- <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                <li><a href="#" stock="${producto.cantidad}" class="producto-agregar" id="${producto.id}"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#">${producto.nombre}</a></h6>
                            <h5>$${producto.precio}</h5>
                        </div>
                    </div>
                </div>`;
                });
                contentpage.innerHTML = '';
                contentproductos.innerHTML = html;
                $('.set-bg').each(function() {
                    var bg = $(this).data('setbg');
                    $(this).css('background-image', 'url(' + bg + ')');
                });
                cargarBotones()
            }
        }
    }
</script>

</body>

</html>