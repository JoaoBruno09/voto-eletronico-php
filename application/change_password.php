<?php
require 'header.php';
include '../user/user.php';


session_start();
?>
<?php if ($_SESSION['user_role'] == 0) {
    ?>
    <div class="container">
        <div style="padding-top: 10px;" class="row">

            <div class="col-2">
                <div class="float-start">
                    <button type="button" style="display:inline-flex;" class="no-btn-user dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user icon-class-user"></i><a style="text-decoration: none;" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;<?php echo utf8_encode($_SESSION['user_name']); ?></a></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="https://voto-eletronico.jbr-projects.pt/application/change_password.php">Alterar Password</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-tabs mb-3" id="myTab0" role="tablist">
                        <li class="nav-item tittle-top-bar-user" role="presentation">
                            <button class="nav-link btn-user-tab active" id="available-events" data-bs-toggle="tab" data-bs-target="#available-events-tab" type="button" role="tab" aria-controls="available-events" aria-selected="true"><i class="far fa-calendar-check icon-class-user"></i><a style="text-decoration: none;" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;Eventos Disponiveis</a></button>
                        </li>
                        <li class="nav-item tittle-top-bar-user" role="presentation">
                            <button class="nav-link btn-user-tab" id="next-events" data-bs-toggle="tab" data-bs-target="#next-events-tab" type="button" role="tab" aria-controls="next-events" aria-selected="false"><i class="far fa-calendar-minus icon-class-user"></i><a style="text-decoration: none;" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;Próximos Eventos</a></button>
                        </li>
                        <li class="nav-item tittle-top-bar-user" role="presentation">
                            <button class="nav-link btn-user-tab" id="historic-events"  data-bs-toggle="tab" data-bs-target="#historic-events-tab" type="button"  role="tab" aria-controls="historic-events" aria-selected="false"><i class="far fa-calendar-times icon-class-user"></i><a style="text-decoration: none;" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;Histórico de Eventos</a></button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="float-end">
                    <button type="button" style="display:inline-flex;" class="no-btn-user" onclick="logout();"><i class="fas fa-power-off icon-class-user"></i><a style="text-decoration: none;" href="https://voto-eletronico.jbr-projects.pt/user/user.php?f=logout_user" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;Sair da Conta</a></button>
                </div>
            </div>
        </div>
    </div>     
    <div id="alterar-password" class="pad-div-page">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="title-login-admin d-flex justify-content-left">Alterar Password</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb-3">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-add" id="user_password" placeholder="Insira a password atual">
                        <label class="text-admin">Insira Password atual</label>
                        <span class="helper-error" id="helper-error-change-password"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="row mb-3">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-add" id="user_new_password" placeholder="Insira a nova password">
                        <label class="text-admin">Insira a sua nova Password</label>
                        <span class="helper-error" id="helper-error-new-password"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row mb-3">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-add" id="user_confirm_new_password" placeholder="Insira a nova password">
                        <label class="text-admin">Confirmar Nova Password</label>
                        <span class="helper-error" id="helper-error-confirm-new-password"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 pad-btn">
                <button id="btn_next" onclick="change_password();" type="button" class="btn btn-first"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Alterar Password</button>
            </div>
        </div>
    </div>
    </body>

    <?php
}
require 'footer.php';
?>
