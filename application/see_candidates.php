<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php if ($_SESSION['user_role'] == 1) {
        ?>

        <div id="ver-candidatos" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Candidatos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm tabela-style table-hover" id="dtb_candidatos" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome do Candidato</th>
                                <th>Partido do Candidato</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_candidates = get_candidates();
                            while ($row = mysqli_fetch_assoc($result_candidates)) {
                                ?>
                                <tr>
                                    <?php if ($row['candidate_name'] == '') { ?>
                                        <th>-----------------------</th>
                                    <?php } else { ?>
                                        <th><?php echo utf8_encode($row['candidate_name']); ?></th>
                                    <?php } ?>
                                    <?php if ($row['candidate_entourage'] == '') { ?>
                                        <th>-----------------------</th>
                                    <?php } else { ?>
                                        <th><?php echo utf8_encode($row['candidate_entourage']); ?></th>
                                    <?php } ?>                    
                                    <th><button class="btn btn-edit" class="" type="button" title="Editar Candidato" onclick="edit_candidate(<?php echo $row['candidate_id']; ?>);"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;<button class="btn btn-delete" type="button" title="Eliminar Candidato" onclick="delete_candidate(<?php echo $row['candidate_id']; ?>);"><i class="fas fa-trash"></i></button></th>
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


