<?php
require 'header.php';
include '../admin/admin.php';
session_start();

/* //VERIFICA SE ALGUEM ESTÁ A ACEDER A ESTE FICHEIRO PELO MÉTODO GET, CASO ESTEJA A FAZER REDIRECIONA PARA A PÁGINA DE ADMINISTRADOR
  if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  header('Location: https://voto-eletronico.jbr-projects.pt/admin');
  } */
?>
<body>
    <?php if ($_SESSION['user_role'] == 1) {
        ?>

        <div id="adicionar-utilizador" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Adicionar Utilizador</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-add" id="add_user_name" placeholder="Insira o nome do utilizador">
                            <label class="text-admin">Insira o nome do utilizador</label>
                            <span class="helper-error" id="helper-error-add-user-name"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control form-add" id="add_user_email" placeholder="Insira o email do utilizador">
                            <label class="text-admin">Insira o email do utilizador</label>
                            <span class="helper-error" id="helper-error-add-user-email"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <select name="add_user_doc" id="add_user_doc" class="form-select form-add" placeholder="Insira o tipo do documento" onchange="this.className = this.options[this.selectedIndex].className">     
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
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control form-add" id="add_user_password" placeholder="Insira a password do utilizador" onkeydown="step_progress_bar_add_user();" onkeyup="step_progress_bar_add_user();" data-bs-toggle="popover_pw" data-bs-content="No minimo 8 caracteres, uma letra minúscula, uma maiúscula, um número e um caractere especial.">
                            <label class="text-admin">Insira a Password</label>
                            <span class="helper-error" id="helper-error-add-user-password"></span>
                            <div class="progress mb-3">
                                <div class="progress-bar" role="progressbar" id="progress-pw" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">15%</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input maxlength="11" onkeypress="return only_numbers(event)" class="form-control form-add" id="add_user_nmri" placeholder="Insira o número de identificação">
                            <label class="text-admin">Insira o número de identificação</label>
                            <span class="helper-error" id="helper-error-add-user-nmri"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control form-add" id="add_user_confirm_password" placeholder="Insira a password do utilizador">
                            <label class="text-admin">Confirmar Password</label>
                            <span class="helper-error" id="helper-error-add-user-confirm-password"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
            <div class="row">
                <div class="col-12 col-md-6 pad-btn">
                    <button id="btn_next" onclick="add_user();" type="button" class="btn btn-first"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Adicionar Utilizador</button>
                </div>
            </div>
        </div>
    </body>
    <?php
}
require 'footer.php';
?>

