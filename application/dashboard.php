<?php
require 'header.php';
include '../admin/admin.php';
session_start();
?>
<body>
    <?php if ($_SESSION['user_role'] == 1) {
        ?>
        <div id="ver-dashboard" class="pad-div-page">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100 py-2 bg-cards">
                        <div class="card-body ">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Total de Utilizadores</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-300"><?php
                                        $result_all_users = get_all_users();
                                        echo get_all_users()
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100 py-2 bg-cards">
                        <div class="card-body ">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Total de Eventos Ativos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-300"><?php
                                        $result_all_events = get_all_events();
                                        echo get_all_events()
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-week fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100 py-2 bg-cards">
                        <div class="card-body ">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Total de Candidatos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-300"><?php
                                        $result_all_candidates = get_all_candidates();
                                        echo get_all_candidates()
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100 py-2 bg-cards">
                        <div class="card-body ">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">
                                        Total de Documentos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-300"><?php
                                        $result_all_documents = get_all_documents();
                                        echo get_all_documents()
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-id-card fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="title-login-admin d-flex justify-content-left">Exporte os Eventos Terminados no Dia Anterior</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm tabela-style table-hover" id="dtb_eventos" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Título</th>
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
                                if ($verificacao_final >= -1 && $verificacao_final < 0) {
                                    ?>
                                    <tr>
                                        <th><?php echo $row['event_id']; ?></th>
                                        <?php $result_event_candidate = get_event_candidates($row['event_id']); ?>
                                        <th><?php echo utf8_encode($row['event_title']); ?></th>
                                        <th><?php echo $row['event_date_exp']; ?></th>
                                        <th><?php echo utf8_encode($row['doc_name']); ?></th>

                                        <th><button class="btn btn-votes" type="button" title="Exportar Votos" onclick="export_votes(<?php echo $row['event_id']; ?>);"><i class="fas fa-file-download"></i></button></th>
                                    </tr>
                                    <?php
                                }
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

