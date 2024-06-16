<?php include "Views/template/header.php"; ?>

<section class="shoping-cart spad">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5">LOGIN</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="form-structor">
                            <div class="signup">
                                <h2 class="form-title" id="signup"><span>or</span>Registrarse</h2>
                                <div class="form-holder">
                                    <input type="text" id="nameRegister" class="input" placeholder="Nombre" />
                                </div>
                                <div class="form-holder">
                                    <input type="email" id="emailRegister" class="input" placeholder="Correo Electrónico" />
                                </div>
                                <div class="form-holder">
                                    <input type="password" id="passwordRegister" class="input" placeholder="Contraseña" />
                                </div>
                                <button class="submit-btn bg-dark text-white" id="btnRegister">Registrarse</button>
                            </div>
                            <div class="login slide-up">
                                <div class="center" style="background-color: #00bcd4;">
                                    <h2 class="form-title" id="loginForm"><span>or</span>Login</h2>
                                    <div class="form-holder mb-3">
                                        <input type="email" id="email" class="input" placeholder="Email" />
                                        <input type="password" id="password" class="input" placeholder="Password" />
                                    </div>
                                    <a href="<?php echo BASE_URL . 'principal/recoverpw'; ?>">Olvidaste tu contraseña?</a>
                                    <button class="submit-btn" id="btnLogin">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "Views/template/footer.php"; ?>

<style>
    .form-holder {
        margin-bottom: 20px;
    }

    .input {
        padding: 12px 15px;
        margin-bottom: 10px;
        border: 1px solid #333; /* Cambiado a color oscuro para mejor visibilidad */
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
        color: #333; /* Color de texto oscuro para mejor visibilidad */
    }

    .submit-btn {
        padding: 15px 45px;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #00bcd4;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0097a7;
    }
</style>

<script src="<?php echo BASE_URL; ?>public/admin/js/jquery.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/js/login.js"></script>
</body>

</html>
