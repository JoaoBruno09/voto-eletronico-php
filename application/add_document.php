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

        <div id="adicionar-doc" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Adicionar Documento</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-add" id="add_document_name" placeholder="Insira o nome do documento">
                            <label class="text-admin">Insira o nome do documento</label>
                            <span class="helper-error" id="helper-error-add-document-name"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 pad-btn">
                    <button id="btn_next" onclick="add_doc();" type="button" class="btn btn-first"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Adicionar Documento</button>
                </div>
            </div>
        </div>
    </body>
    <?php
}
require 'footer.php';
?>

