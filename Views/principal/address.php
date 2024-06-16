<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5">Dirección de Envío</h5>
                <div class="card">
                    <div class="card-body">
                        <form autocomplete="off" id="frmEnvio">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Nombres</span>
                                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo (!empty($_SESSION['address']['nombre'])) ? $_SESSION['address']['nombre'] : ''; ?>" placeholder="Nombres *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Apellidos</span>
                                        <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo (!empty($_SESSION['address']['apellido'])) ? $_SESSION['address']['apellido'] : ''; ?>" placeholder="Apellidos *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Dirección</span>
                                        <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo (!empty($_SESSION['address']['direccion'])) ? $_SESSION['address']['direccion'] : ''; ?>" placeholder="Dirección *">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Ciudad</span>
                                        <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?php echo (!empty($_SESSION['address']['ciudad'])) ? $_SESSION['address']['ciudad'] : ''; ?>" placeholder="Ciudad *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Código postal</span>
                                        <input type="text" id="cod" name="cod" class="form-control" value="<?php echo (!empty($_SESSION['address']['cod'])) ? $_SESSION['address']['cod'] : ''; ?>" placeholder="Cod postal *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">País</span>
                                        <input type="text" id="pais" name="pais" class="form-control" value="<?php echo (!empty($_SESSION['address']['pais'])) ? $_SESSION['address']['pais'] : ''; ?>" placeholder="País *">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Teléfono</span>
                                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?php echo (!empty($_SESSION['address']['telefono'])) ? $_SESSION['address']['telefono'] : ''; ?>" placeholder="Teléfono *">
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group" role="group" aria-label="Button group name">
                                <button type="submit" class="btn btn-primary">
                                    Siguiente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>

<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const frmEnvio = document.querySelector("#frmEnvio");

        frmEnvio.onsubmit = function(e) {
            e.preventDefault();

            // Validación básica del formulario
            if (
                frmEnvio.nombre.value.trim() === "" ||
                frmEnvio.apellido.value.trim() === "" ||
                frmEnvio.direccion.value.trim() === "" ||
                frmEnvio.ciudad.value.trim() === "" ||
                frmEnvio.cod.value.trim() === "" ||
                frmEnvio.pais.value.trim() === "" ||
                frmEnvio.telefono.value.trim() === ""
            ) {
                alert("Todos los campos son requeridos");
            } else {
                // Envío del formulario via AJAX
                const url = ruta + "principal/envio";
                const formData = new FormData(frmEnvio);
                
                fetch(url, {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Manejo de la respuesta del servidor
                    if (data.icono === "success") {
                        alerta(data.msg.toUpperCase(), 1); // Éxito
                        setTimeout(() => {
                            window.location = ruta + "principal/pagos";
                        }, 1500);
                    } else {
                        alerta(data.msg.toUpperCase(), 2); // Error
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Ha ocurrido un error al procesar la solicitud");
                });
            }
        };
    });
</script>
