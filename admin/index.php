<?php
require '../application/header.php';
include "admin.php";
session_start();
?>
<body class="body-admin">
    <?php if ($_SESSION['user_role'] != 1) {
        ?>
        <div id="wrapper-admin">
            <div id="content-wrapper-admin" class="d-flex justify-content-center">
                <div class="container">
                    <div class="login-admin">
                        <h1 class="title-login-admin">Login Administrador</h1>
                        <div class="login-admin-back">
                            <div class="d-flex justify-content-center">
                                <img alt="Logo" class="img-fluid logo mb-3" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
                            </div>
                            <div class="d-flex justify-content-center">
                                <?php if (isset($_SESSION['no_result'])) {
                                    ?> 
                                    <div class="alert alert-danger" role="alert">
                                        <h5>Administrador não existe!</h5>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center">
                                        <div id="login_admin_total_div">
                                            <div id="login_admin_second_div">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div class="form-floating">
                                                            <input type="email" class="form-control form-login" id="admin_email" placeholder="Insira o seu Email">
                                                            <label class="text-admin">Insira o seu Email</label>
                                                            <span class="helper-error" id="helper-error-admin-email"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="form-floating">
                                                            <input type="password" class="form-control form-login" id="admin_password" placeholder="Insira a sua Password">
                                                            <label class="text-admin">Insira a sua Password</label>
                                                            <span class="helper-error" id="helper-error-admin-password"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" id="recover_admin_password">
                                                        <a style="text-decoration: none;color: #fff;" id="forget_password_admin" href="#">Esqueceu-se da sua password?</a>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-sm-12 d-flex justify-content-center">
                                                            <button id="btn_next" onclick="admin_login();" type="button" class="btn btn-first"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Entrar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div id="wrapper-admin">
            <?php
            require '../application/sidebar-admin.php';
            ?>
            <div id="content-wrapper-admin" class="d-flex flex-column">
                <div>
                    <?php
                    require '../application/topbar-admin.php';
                    ?>
                    <div class="container-fluid" id="mid">

                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
}
require '../application/footer.php';
?>



