<?php
require 'header.php';
require 'Db_connection.php';
?>
<body class="body-user">
    <?php
    if ($_GET['email'] && $_GET['key']) {
        $email = $_GET['email'];
        $key = $_GET['key'];
        $role = $_GET['role'];
        $query = mysqli_query(
                $connection, "SELECT * FROM `users` WHERE `user_key`='" . $key . "' AND `user_email`='" . $email . "'AND `user_role`='" . $role . "'"
        );
        $curDate = date("Y-m-d H:i:s");
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_array($query);
            if ($row['user_exp_pw_date'] >= $curDate) {
                ?>
                <div id="wrapper-admin">
                    <div id="content-wrapper-admin" class="d-flex justify-content-center">
                        <div class="container">
                            <div class="login-admin">
                                <h1 class="title-login-user">Alteração da Password</h1>
                                <div class="login-user-back">
                                    <div class="d-flex justify-content-center">
                                        <img class="img-fluid logo mb-3" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center">
                                                <div class="row mb-3">
                                                    <div class="form-floating ">
                                                        <input type="password" class="form-control form-login" id='change_password' placeholder="Insira a sua password" onkeydown="step_progress_bar();" onkeyup="step_progress_bar();" data-bs-toggle="popover_pw" data-bs-content="No minimo 8 caracteres, uma letra minúscula, uma maiúscula, um número e um caractere especial.">           
                                                        <label class="text-admin">Insira a sua password</label>
                                                        <span class="helper-error" id="helper-error-login-recoverpw-password"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="row mb-3">
                                                    <div class="form-floating ">
                                                        <input type="password" class="form-control form-login" id='change_confirm_password' placeholder="Confirmar password">
                                                        <label class="text-admin">Confirmar Password</label>
                                                        <span class="helper-error" id="helper-error-login-recoverpw-confirm-password"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12  progress mb-3">
                                                <div class="progress-bar" role="progressbar" id="progress-pw" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">15%</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 d-flex justify-content-center">
                                                    <button type="button" class="btn btn-first" onclick="recover_password('<?php echo $email; ?>', '<?php echo $role; ?>', '<?php echo $key; ?>');">Alterar Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else {
                ?>
                <div id="wrapper-admin">
                    <div id="content-wrapper-admin" class="d-flex justify-content-center">
                        <div class="container">
                            <div class="login-admin">
                                <h1 class="title-login-user">Alteração da Password</h1>
                                <div class="login-user-back">
                                    <div class="d-flex justify-content-center">
                                        <img class="img-fluid logo mb-3" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center">
                                                <div class="alert alert-danger" role="alert">
                                                    O tempo para a alteração da password expirou
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
            }
        } else {
            ?>
            <div id="wrapper-admin">
                <div id="content-wrapper-admin" class="d-flex justify-content-center">
                    <div class="container">
                        <div class="login-admin">
                            <h1 class="title-login-user">Alteração da Password</h1>
                            <div class="login-user-back">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid logo mb-3" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex justify-content-center">
                                            <div class="alert alert-danger" role="alert">
                                                O tempo para a alteração da password expirou
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
        <?php
    }
}
require 'footer.php';
?>
