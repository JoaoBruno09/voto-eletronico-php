<?php
require 'application/header.php';
require 'user/user.php';
session_start();
?>
<body class="body-user">
    <?php if (!$_SESSION['user_name'] || $_SESSION['user_role'] != 0) {
        ?>
        <div id="wrapper-admin">
            <div id="content-wrapper-admin" class="d-flex justify-content-center">
                <div class="container">
                    <div class="login-admin">
                        <h1 class="title-login-user">Login</h1>
                        <div class="login-user-back">
                            <div class="d-flex justify-content-center">
                                <img alt="Logo" class="img-fluid logo mb-3" src="https://voto-eletronico.jbr-projects.pt/assets/img/logo.png">
                            </div>
                            <div class="d-flex justify-content-center">
                                <?php if (isset($_SESSION['no_result'])) {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        <h5>Utilizador não existe!</h5>
                                    </div> 
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-center">
                                        <div id="login_user_total_div">
                                            <div id="login_user_second_div">
                                                <form>
                                                    <div class="row mb-3">
                                                        <div id="document_type_div" class="form-floating">
                                                            <select name="login_user_doc" id="login_user_doc" class="form-select form-login form-add"  onchange="this.className = this.options[this.selectedIndex].className">     
                                                                <option class="form-select options-select" selected disabled>Selecione uma opção</option>
                                                                <?php
                                                                $result_docs = get_docs();
                                                                while ($row = mysqli_fetch_assoc($result_docs)) {
                                                                    ?>
                                                                    <option class="form-select options-select" value="<?php echo utf8_encode($row['doc_id']); ?>"><?php echo utf8_encode($row['doc_name']); ?></option>     
                                                                    <?php
                                                                }
                                                                ?>           
                                                            </select>
                                                            <label class="text-admin">Insira o tipo do documento</label>
                                                            <span class="helper-error" id="helper-error-add-user-doc_type"></span>
                                                        </div>
                                                    </div>
                                                    <div id="div_login_user_nmri" class="row mb-3">
                                                        <div class="form-floating ">
                                                            <input type="text" class="form-control form-login" id="login_user_nmri" maxlength="11" onkeypress="return only_numbers(event)" placeholder="Insira o número de identificação">
                                                            <label class="text-admin">Insira o número de identificação</label>
                                                            <span class="helper-error" id="helper-error-login-user-nmri"></span>
                                                        </div>
                                                    </div>
                                                    <div id="pw" class="row mb-3">
                                                        <div class="form-floating ">
                                                            <input type="password" class="form-control form-login" id="login_user_password" placeholder="Insira a sua password">
                                                            <label class="text-admin">Insira a sua password</label>
                                                            <span class="helper-error" id="helper-error-login-password"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3" id="recover_password">
                                                        <a style="text-decoration: none;color: #fff;" id="forget_password_user" href="#">Esqueceu-se da sua password?</a>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 d-flex justify-content-center">
                                                            <button id="btn_next" onclick="user_verify();" type="button" class="btn btn-first" disabled><i class="fas fa-arrow-circle-right"></i>&nbsp;&nbsp;Seguinte</button>
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
        <div class="container">
            <div style="padding-top: 10px;" class="row">

                <div class="col-2">
                    <div class="float-start">
                        <button type="button" style="display:inline-flex;" class="no-btn-user dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user icon-class-user"></i><a style="text-decoration: none;" type="button" class="d-none d-sm-none d-md-none d-lg-none d-xl-block tittle-top-bar-user">&nbsp;&nbsp;<?php echo utf8_encode($_SESSION['user_name']); ?></a></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_change_password">Alterar Password</button></li>
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
        <div class="container">
            <div class="tab-content" id="myTabContent0">
                <div class="tab-pane fade show active" id="available-events-tab" role="tabpanel" aria-labelledby="home-tab0" >
                    <div class="pad-div-tabs" id="eventos_disponiveis">
                        <p>Eventos disponiveis para votar:</p>
                        <div class="list-group">    
                            <?php
                            $result_event_user = get_event_users();
                            while ($row = mysqli_fetch_assoc($result_event_user)) {
                                $data_inicial = strtotime($row['event_date_ini']);
                                $verificacao = ceil(($data_inicial - time()) / 60 / 60 / 24);
                                $data_exp = strtotime($row['event_date_exp']);
                                $verificacao_final = ceil(($data_exp - time()) / 60 / 60 / 24);
                                $data_atual = date("Y-m-d");
                                if ($verificacao <= 0 && $verificacao_final >= 0) {
                                    ?>
                                    <li class="list-group-item list-group-item-action mb-3 list-events_user">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-user"><?php echo utf8_encode($row['event_title']); ?></h5>
                                            <small><?php echo $verificacao_final; ?> dias para terminar</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <?php if ($row['event_description'] == '') {
                                                    ?>
                                                    <p class="mb-1">Sem Descrição.</p>
                                                <?php } else { ?>
                                                    <p class="mb-1"><?php echo utf8_encode($row['event_description']); ?></p>
                                                <?php } ?>
                                                <p class="mb-1"><?php echo date("d-m-Y", strtotime($row['event_date_ini'])); ?>&nbsp;-&nbsp;<?php echo date("d-m-Y", strtotime($row['event_date_exp'])) ?></p> 
                                            </div>                   
                                            <div class="col-lg-3">
                                                <?php
                                                $check_vote = check_vote($row['event_id']);
                                                if ($check_vote == true) {
                                                    ?>
                                                    <h4 class="float-end" style="color:green;">Já votou neste evento</h4>
                                                <?php } else {
                                                    ?>
                                                    <th><button type="button" class="btn btn-first float-end" title="Votar" onclick="see_candidates_user_event(<?php echo $row['event_id']; ?>);"><i class="fas fa-vote-yea"></i>&nbsp;&nbsp;Votar</button></th>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="next-events-tab" role="tabpanel" aria-labelledby="profile-tab0">
                    <div class="pad-div-tabs" id="próximos_eventos">
                        <p>Eventos nos próximos 15 dias:</p>
                        <div class="list-group">
                            <?php
                            $result_event_user_two = get_event_users();
                            while ($row = mysqli_fetch_assoc($result_event_user_two)) {
                                $data_inicial = strtotime($row['event_date_ini']);
                                $verificacao = ceil(($data_inicial - time()) / 60 / 60 / 24);
                                $data_exp = strtotime($row['event_date_exp']);
                                $verificacao_final = ceil(($data_exp - time()) / 60 / 60 / 24);
                                $data_atual = date("Y-m-d");
                                if ($verificacao <= 14 && $verificacao > 0) {
                                    ?>
                                    <li class="list-group-item list-group-item-action mb-3 list-events_user">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-user"><?php echo utf8_encode($row['event_title']); ?></h5>
                                            <small><?php echo $verificacao; ?> dias para começar</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <?php if ($row['event_description'] == '') {
                                                    ?>
                                                    <p class="mb-1">Sem Descrição.</p>
                                                <?php } else { ?>
                                                    <p class="mb-1"><?php echo utf8_encode($row['event_description']); ?></p>
                                                <?php } ?>
                                                <p class="mb-1"><?php echo date("d-m-Y", strtotime($row['event_date_ini'])); ?>&nbsp;-&nbsp;<?php echo date("d-m-Y", strtotime($row['event_date_exp'])) ?></p> 
                                            </div>                   
                                            <div class="col-lg-4">
                                                <h5 class="float-end" style="color:#d8a30c;">Ainda não é possivel votar neste evento</h5>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="historic-events-tab" role="tabpanel" aria-labelledby="contact-tab0">
                    <div class="pad-div-tabs" id="historico_eventos">
                        <p>Eventos nos últimos 15 dias:</p>
                        <div class="list-group">
                            <?php
                            $result_event_user_two = get_event_users();
                            while ($row = mysqli_fetch_assoc($result_event_user_two)) {
                                $data_inicial = strtotime($row['event_date_ini']);
                                $verificacao = ceil(($data_inicial - time()) / 60 / 60 / 24);
                                $data_exp = strtotime($row['event_date_exp']);
                                $verificacao_final = ceil(($data_exp - time()) / 60 / 60 / 24);
                                if ($verificacao_final >= -14 && $verificacao_final < 0) {
                                    ?>
                                    <li class="list-group-item list-group-item-action mb-3 list-events_user">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1 text-user"><?php echo utf8_encode($row['event_title']); ?></h5>
                                            <small>Terminado</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <?php if ($row['event_description'] == '') {
                                                    ?>
                                                    <p class="mb-1">Sem Descrição.</p>
                                                <?php } else { ?>
                                                    <p class="mb-1"><?php echo utf8_encode($row['event_description']); ?></p>
                                                <?php } ?>
                                                <p class="mb-1"><?php echo date("d-m-Y", strtotime($row['event_date_ini'])); ?>&nbsp;-&nbsp;<?php echo date("d-m-Y", strtotime($row['event_date_exp'])) ?></p> 
                                            </div>                   
                                            <div class="col-lg-4">
                                                <button class="btn btn-first float-end" id="btn_see_events" title="Ver Resultados" onclick="see_results_event(<?php echo $row['event_id']; ?>);"><i class="fas fa-poll"></i>&nbsp;&nbsp;Ver Resultados</button>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['user_change_pw'] == 0) { ?>
                <input type="hidden" id="check_pw" value="<?php echo $_SESSION['user_change_pw'] ?>">
            <?php } ?>
        </div>

        <div class="modal fade" id="modal_change_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="col-form-label">Password Atual:</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <input type="password" class="form-control" id="user_password">
                                        <span class="helper-error" id="helper-error-change-user-password"></span>
                                        <span class="helper-success" id="helper-success-change-user-password"></span>
                                    </div>

                                </div> 
                                <div class="row ">
                                    <div class="col-12">
                                        <button type="button" id="btn-verify-user-password" style="width:30%;" class="btn btn-first" onclick="verify_user_password();"><i class="far fa-check-circle"></i>&nbsp;&nbsp;Verificar</button>
                                    </div>    
                                </div> 
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Nova password:</label>
                                <input type="password" class="form-control" id="user_new_password" disabled="" onkeydown="step_progress_bar_change_user_pw();" onkeyup="step_progress_bar_change_user_pw();" data-bs-toggle="popover_pw" data-bs-content="No minimo 8 caracteres, uma letra minúscula, uma maiúscula, um número e um caractere especial.">
                                <span class="helper-error" id="helper-error-user-new-password"></span>
                                <div class="progress mb-3">
                                    <div class="progress-bar" role="progressbar" id="progress-pw" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">15%</div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label  class="col-form-label">Confirmar nova password:</label>
                                <input type="password" class="form-control" id="user_confirm_new_password" disabled="">
                                <span class="helper-error" id="helper-error-user-confirm-new-password"></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="font-size: 20px;" class="btn btn-danger" data-bs-dismiss="modal"><i class="far fa-times-circle"></i>&nbsp;&nbsp;Fechar</button>
                        <button type="button" style="width:30%;" id="btn-change-user-password" class="btn btn-first" onclick="change_password();" disabled=""><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Alterar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <?php
}
require 'application/footer.php';
?>


