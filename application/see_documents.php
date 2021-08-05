<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php
    if ($_SESSION['user_role'] == 1) {
        ?>

        <div id="ver-documentos" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Documentos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm tabela-style table-hover" id="dtb_tipos_de_documento" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome do Documento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_docs = get_docs();
                            while ($row = mysqli_fetch_assoc($result_docs)) {
                                ?>
                                <tr>
                                    <th><?php echo utf8_encode($row['doc_name']); ?></th>
                                    <th><button class="btn btn-edit" type="button" title="Editar Documento" onclick="edit_document(<?php echo $row['doc_id']; ?>);"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-delete" type="button" title="Eliminar Documento" onclick="delete_document_type(<?php echo $row['doc_id']; ?>);"><i class="fas fa-trash"></i></button></th>
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




