<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php if ($_SESSION['user_role'] == 1) {
        ?>
        <div id="adicionar-evento" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Adicionar Evento</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-add" id="add_event_title" placeholder="Insira o titulo do evento">
                            <label class="text-admin">Insira o titulo do evento</label>
                            <span class="helper-error" id="helper-error-add-event-title"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <select name="add_event_doc" id="add_event_doc" class="form-select form-add" placeholder="Insira o tipo do documento" onchange="this.className = this.options[this.selectedIndex].className">     
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
                            <span class="helper-error" id="helper-error-add-event-doc_type"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input class="form-control form-add" id="add_event_date_ini" type="date" placeholder="Insira a data inicial">
                            <label class="text-admin">Insira a data inicial</label>
                            <span class="helper-error" id="helper-error-add-event-date-ini"></span>
                        </div>
                    </div>   
                </div>
                <div class="col-sm-6">
                    <div class="row mb-3">
                        <div class="form-floating">
                            <textarea class="mb-3 form-control form-add" id="add_event_description" placeholder="Insira a descrição do Evento" style="height: 180px"></textarea>
                            <label class="text-admin">Insira a descrição do Evento </label>
                            <span class="helper-error" id="helper-error-add-event-description"></span>
                        </div>
                    </div>     
                    <div class="row mb-3">
                        <div class="form-floating mb-3">
                            <input class="form-control form-add" id="add_event_date_exp" type="date" placeholder="Insira a data de expiração">
                            <label class="text-admin">Insira a data de expiração</label>
                            <span class="helper-error" id="helper-error-add-event-date-exp"></span>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 pad-btn">
                    <button id="btn_next" onclick="add_event();" type="button" class="btn btn-first"><i class="fas fa-plus-circle"></i>&nbsp;&nbsp;Adicionar Evento</button>
                </div>
            </div>
        </div>
    </body>
    <?php
}
require 'footer.php';
?>