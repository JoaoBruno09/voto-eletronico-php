<?php

require 'Db_connection.php';
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';


//VERIFICA SE ALGUEM ESTÁ A ACEDER A ESTE FICHEIRO PELO MÉTODO GET, CASO ESTEJA A FAZER REDIRECIONA PARA A PÁGINA DE ADMINISTRADOR
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('Location: https://voto-eletronico.jbr-projects.pt/');
}



$actual_date = date('Y-m-d H:m:s');
$query_verify_date = "SELECT * FROM events as e ORDER BY event_id DESC";
$result_verify_date = mysqli_query($connection, $query_verify_date);
$max_votes = -1;
$candidate_winner = '';
if (mysqli_num_rows($result_verify_date) > 0) {
    while ($value_query = mysqli_fetch_assoc($result_verify_date)) {
        $output = '';
        if ($actual_date > $value_query['event_date_exp'] && $value_query['event_n_votes'] == '') {
            $event_id = $value_query['event_id'];
            $event_title = $value_query['event_title'];
            $event_description = $value_query['event_description'];
            $event_date_exp = $value_query['event_date_exp'];
            $event_doc = $value_query['doc_id'];
            $query_count_votes = "SELECT * FROM votes WHERE event_id='$event_id'";
            $result_count_votes = mysqli_query($connection, $query_count_votes);
            if (mysqli_num_rows($result_count_votes) >= 0) {
                $event_n_votes = mysqli_num_rows($result_count_votes);
                $query_insert_n_votes = "UPDATE events SET event_n_votes='$event_n_votes' WHERE event_id='$event_id'";
                $result_insert_n_votes = mysqli_query($connection, $query_insert_n_votes);
                $query_n_registed_users = "SELECT * FROM users AS u LEFT OUTER JOIN events AS e ON u.doc_id=e.doc_id WHERE e.doc_id='$event_doc' AND event_id='$event_id'";
                $result_n_registed_users = mysqli_query($connection, $query_n_registed_users);
                $n_all_users = mysqli_num_rows($result_n_registed_users);
                $no_vote = $n_all_users - $event_n_votes;
                $query_n_candidate_votes = "SELECT v.user_id,u.user_email,v.candidate_id, c.candidate_name,c.candidate_entourage, COUNT(*) AS n_votos FROM votes as v LEFT JOIN candidates as c ON c.candidate_id=v.candidate_id LEFT JOIN users as u ON u.user_id=v.user_id WHERE event_id='$event_id' GROUP BY v.candidate_id ORDER BY n_votos DESC";
                $result_n_candidate_votes = mysqli_query($connection, $query_n_candidate_votes);
                $max_votes = 0;
                $candidate_winner = '';
                $more_than_one = false;
                $created_new_event = false;
                $output .= '
                        <table class="table" bordered="1">  
                        <tr>  
                        <th>Nome do Candidato</th>  
                        <th>Partido do Candidato</th>  
                        <th>Número de Votos</th>
                        </tr>';
                $result_n_candidate_votes = mysqli_query($connection, $query_n_candidate_votes);
                while ($row = mysqli_fetch_assoc($result_n_candidate_votes)) {
                    if ($row['candidate_id'] == 0) {
                        $output .= '
                        <tr>  
                        <td>Voto em Branco</td>  
                        <td>-----------------</td>  
                        <td>' . $row["n_votos"] . '</td>
                        </tr>';
                    } else if ($row['candidate_name'] != '') {
                        $output .= '
                        <tr>  
                        <td>' . utf8_encode($row["candidate_name"]) . '</td>  
                        <td>-----------------</td>  
                        <td>' . $row["n_votos"] . '</td>
                        </tr>';
                    } else {
                        $output .= '
                        <tr>
                        <td>-----------------</td>
                        <td>' . utf8_encode($row["candidate_entourage"]) . '</td>  
                        <td>' . $row["n_votos"] . '</td>
                        </tr>';
                    }
                    if ($row['candidate_id'] != 0 && $row['n_votos'] > $max_votes) {
                        $candidate_id_first = $row['candidate_id'];
                        $first_inserted = false;
                        if ($row['candidate_name'] != '') {
                            $candidate_winner = $row['candidate_name'];
                        } else {
                            $candidate_winner = $row['candidate_entourage'];
                        }
                    }
                    if ($row['candidate_id'] != 0 && $row['n_votos'] == $max_votes) {
                        $candidate_id = $row['candidate_id'];
                        $more_than_one = true;
                        if ($row['candidate_name'] != '') {
                            $candidate_winner .= $row['candidate_name'] . ",";
                        } else {
                            $candidate_winner .= $row['candidate_entourage'] . ",";
                        }
                        $initial_date = date('Y/m/d', strtotime('+1 days', strtotime($event_date_exp)));
                        $expire_date = date('Y/m/d', strtotime('+2 days', strtotime($event_date_exp)));
                        if ($created_new_event == false) {
                            $query_new_event = "INSERT INTO events (event_title, event_date_ini, event_date_exp, doc_id)
                              VALUES ('$event_title(2)', '$initial_date', '$expire_date','$event_doc')";
                            $result_new_event = mysqli_query($connection, $query_new_event);
                        }
                        $created_new_event = true;
                        $query_get_event = "SELECT event_id FROM events ORDER BY event_id DESC LIMIT 1";
                        $result_get_event = mysqli_query($connection, $query_get_event);
                        if (mysqli_num_rows($result_get_event) > 0) {
                            while ($value_query = mysqli_fetch_assoc($result_get_event)) {
                                $event_id_new = $value_query['event_id'];
                                break;
                            }
                            if ($first_inserted == false) {
                                $query_insert_candidates_new_event = "INSERT INTO events_candidates (event_id, candidate_id) VALUES ('$event_id_new', '$candidate_id_first')";
                                $result_insert_candidates_new_event = mysqli_query($connection, $query_insert_candidates_new_event);
                                $first_inserted = true;
                            }
                            $query_insert_candidates_new_event = "INSERT INTO events_candidates (event_id, candidate_id) VALUES ('$event_id_new', '$candidate_id')";
                            $result_insert_candidates_new_event = mysqli_query($connection, $query_insert_candidates_new_event);
                        }
                    }
                    if ($row['candidate_id'] != 0 && $row['n_votos'] > $max_votes) {
                        $max_votes = $row['n_votos'];
                    }
                }
                $output .= '
                        <tr>  
                        <td>Votos nulos</td>  
                        <td>-----------------</td>  
                        <td>' . $no_vote . '</td>
                        </tr>';
                $output .= '</table>';
                $result_n_candidate_votes = mysqli_query($connection, $query_n_candidate_votes);
                while ($row2 = mysqli_fetch_assoc($result_n_candidate_votes)) {
                    $user_email = utf8_encode($row2['user_email']);
                    if ($max_votes == 0) {
                        $message = file_get_contents('../application/email.php');
                        $info_email = utf8_decode("Não existe vencedor do evento, pois houve $max_votes votos");
                        $message = str_replace('%info_email%', $info_email, $message);
                    } else {
                        if ($more_than_one == true) {
                            $message = file_get_contents('../application/email.php');
                            $info_email = utf8_encode("Vencedores do evento: $candidate_winner com $max_votes votos <br><br>OBS: De forma a desempatar o evento, foi criado um evento com o nome $event_title(2). Aceda com a sua conta para votar novamente em voto-eletronico.jbr-projects.pt <br><br>") . $output;
                            $message = str_replace('%info_email%', $info_email, $message);
                        } else {
                            $message = file_get_contents('../application/email.php');
                            $info_email = utf8_encode("Vencedor do evento: $candidate_winner com $max_votes votos <br><br>") . $output;
                           $message = str_replace('%info_email%', $info_email, $message);
                        }
                    }

                    $mail = new PHPMailer;

                    $mail->isSMTP();
                    $mail->Host = 'voto-eletronico.jbr-projects.pt';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'geral@voto-eletronico.jbr-projects.pt';
                    $mail->Password = 'voto_hj12345';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                    $mail->addAddress($user_email);

                    $mail->isHTML(true);
                    $mail->Subject = utf8_decode("Resultados do evento $event_id");
                    $mail->MsgHTML($message);

                    //ENVIAR AO EMAIL AO UTILIZADOR COM O VENCEDOR OU VENCEDORES DO EVENTO
                    if (!$mail->send()) {
                        $mail->ErrorInfo;
                    }
                }
            }
        }
    }
}


        