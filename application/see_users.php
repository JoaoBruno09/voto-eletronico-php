<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php
    if ($_SESSION['user_role'] == 1) {
        ?>

        <div id="ver-utilizadores" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Utilizadores</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm tabela-style table-hover" id="dtb_utilizadores" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Tipo de Documento</th>
                                <th>Número de Identificação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_users = get_users();
                            while ($row = mysqli_fetch_assoc($result_users)) {
                                ?>
                                <tr>
                                    <th><?php echo utf8_encode($row['user_name']); ?></th>
                                    <th><?php echo utf8_encode($row['user_email']); ?></th>
                                    <th><?php echo utf8_encode($row['doc_name']); ?></th>
                                    <th><?php echo utf8_encode($row['user_nmri']); ?></th>             
                                    <th><button class="btn btn-edit" type="button" title="Editar Utilizador" onclick="edit_user(<?php echo $row['user_id']; ?>);"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-delete" name="btn_delete_user" type="button" title="Eliminar Utilizador" onclick="delete_user(<?php echo $row['user_id']; ?>);"><i class="fas fa-trash"></i></button></th>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <?php
}
require 'footer.php';
?>