<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php
    if ($_SESSION['user_role'] == 1) {
        ?>
        <div id="ver-eventos" class="pad-div-page">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Eventos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm tabela-style table-hover" id="dtb_eventos" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Título</th>
                                <th>Data Inicial</th>
                                <th>Data de Expiração</th>
                                <th>Tipo de Documento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result_events = get_events();

                            $result_candidates = get_candidates();
                            while ($row = mysqli_fetch_assoc($result_events)) {
                                $data_inicial = strtotime($row['event_date_ini']);
                                $verificacao = ceil(($data_inicial - time()) / 60 / 60 / 24);
                                $data_exp = strtotime($row['event_date_exp']);
                                $verificacao_final = ceil(($data_exp - time()) / 60 / 60 / 24);
                                ?>
                                <tr>
                                    <th><?php echo $row['event_id']; ?></th>
                                    <?php $result_event_candidate = get_event_candidates($row['event_id']); ?>
                                    <th><?php echo utf8_encode($row['event_title']); ?></th>
                                    <th><?php echo $row['event_date_ini']; ?></th>
                                    <th><?php echo $row['event_date_exp']; ?></th>
                                    <th><?php echo utf8_encode($row['doc_name']); ?></th>

                                    <th><?php if (mysqli_num_rows($result_candidates) != 0 && $verificacao > 0) { ?><button class="btn btn-add-candidates" type="button" title="Adicionar Candidato" onclick="add_candidate_toevent(<?php echo $row['event_id']; ?>);"><i class="fas fa-user-plus"></i></button>&nbsp;&nbsp;<?php }if (mysqli_num_rows($result_event_candidate) != 0 && $verificacao <= 0) { ?><button class="btn btn-see-candidates" type="button" title="Ver Candidatos" onclick="see_candidates_event(<?php echo $row['event_id']; ?>);"><i class="fas fa-eye"></i></button>&nbsp;&nbsp;<?php } ?><?php if (mysqli_num_rows($result_event_candidate) != 0 && $verificacao > 0) { ?><button class="btn btn-see-candidates" type="button" title="Ver Candidatos" onclick="see_candidates_event_delete(<?php echo $row['event_id']; ?>);"><i class="fas fa-eye"></i></button>&nbsp;&nbsp;<?php } ?><?php if ($verificacao_final < 0) { ?><button class="btn btn-results" id="btn_see_events" title="Ver Resultados" onclick="see_results_event_admin(<?php echo $row['event_id']; ?>);"><i class="fas fa-poll"></i></button>&nbsp;&nbsp;<button class="btn btn-votes" type="button" title="Exportar Votos" onclick="export_votes(<?php echo $row['event_id']; ?>);"><i class="fas fa-file-download"></i></button>&nbsp;&nbsp;<?php } ?><?php if ($verificacao > 0) { ?><button class="btn btn-edit" type="button" title="Editar Evento" onclick="edit_event(<?php echo $row['event_id']; ?>);"><i class="fas fa-edit"></i></button>&nbsp;&nbsp;<?php } ?> <?php if ($verificacao > 0 || $verificacao_final < 0) { ?><button class="btn btn-delete" type="button" title="Eliminar Evento" onclick="delete_event(<?php echo $row['event_id']; ?>);"><i class="fas fa-trash"></i></button><?php } ?></th>
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