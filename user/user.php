<?php

include '../application/Db_connection.php';
include '../application/PHPMailer-5.2-stable/PHPMailerAutoload.php';

session_start();

//VERIFICA SE ALGUEM ESTÁ A ACEDER A ESTE FICHEIRO PELO MÉTODO GET, CASO ESTEJA A FAZER REDIRECIONA PARA A PÁGINA DE UTILIZADOR
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('Location: https://voto-eletronico.jbr-projects.pt/');
}

//RECEBE O NOME DA FUNÇÃO PELO MÉTODO GET, VERIFICA SE ELA EXISTE E ENTRA NA MESMA
$function = $_GET['f'];
if (function_exists($function)) {
    call_user_func($function);
}

//FUNÇÃO PARA A VERIFICAÇÃO DO UTILIZADOR
function verify_user() {
    include '../application/Db_connection.php';
    include '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

//se for false não existe o utilizador na bd, se for true já existe
        $_SESSION['no_result'] = false;
//se houver um user e se tiver enviado um email com a key a esse utilizador então a variavel passa a true e diz ao jquery para acrescentar o input para inserção da key
        $user_found = false;
        if (isset($_POST['user_document_type']) && isset($_POST['user_password']) && isset($_POST['user_nmri'])) {
            $user_document_type = $_POST['user_document_type'];
            $user_password = $_POST['user_password'];
            $user_nmri = $_POST['user_nmri'];
            $user_password = utf8_decode($user_password);
            $user_password = md5($user_password);


            $query = "SELECT * FROM users WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";

            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {

                $user_key = md5(microtime() . rand());
                $query_insert = "UPDATE users SET user_key='$user_key' WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";
                $query_get_email = "SELECT * FROM users WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";
                $result_insert = mysqli_query($connection, $query_insert);
                $result_after = mysqli_query($connection, $query_get_email);

//select à bd para receber as informações do utilizador que está a tentar fazer o login
                while ($value_query = mysqli_fetch_assoc($result_after)) {
                    $user_name = $value_query["user_name"];
                    $user_password = $value_query["user_password"];
                    $user_email = $value_query["user_email"];
                    $user_nmri = $value_query["user_nmri"];
                    $user_document_type = $value_query["doc_id"];
                    $user_change_pw = $value_query["user_change_pw"];
                    $user_key = $value_query["user_key"];
                }

                $message = file_get_contents('../application/email.php');
                $info_email = utf8_decode("A sua chave de segurança para iniciar sessão em voto-eletronico.jbr-projects.pt: <br><br>$user_key");
                $message = str_replace('%info_email%', $info_email, $message);

                $mail = new PHPMailer;

               $mail->isSMTP();
                $mail->Host = 'yourhost';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourusername';
                $mail->Password = 'yourpassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = utf8_decode('Palavra-Chave de Segurança para iniciar a sessão');
                $mail->MsgHTML($message);
                $mail->AltBody = utf8_decode("A sua chave de segurança para iniciar sessao em voto-eletronico.jbr-projects.pt: $user_key");

//ENVIAR AO EMAIL AO UTILIZADOR COM A KEY
                if (!$mail->send()) {
                    $mail->ErrorInfo;
                }
                $user_found = true;
                echo $user_found;
            } else {
                $_SESSION['no_result'] = true;
                header("Location: https://voto-eletronico.jbr-projects.pt");
            }
        }
    }
}

//FUNÇÃO QUE FAZ O LOGIN DO UTILIZADOR
function login_user() {
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_logged = false;
        if (isset($_POST['user_document_type']) && isset($_POST['user_password']) && isset($_POST['user_nmri']) && isset($_POST['user_key'])) {
            $user_document_type = $_POST['user_document_type'];
            $user_password = $_POST['user_password'];
            $user_nmri = $_POST['user_nmri'];
            $user_password = utf8_decode($user_password);
            $user_password = md5($user_password);
            $user_key = $_POST['user_key'];

            $query = "SELECT * FROM users WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_key='$user_key' AND user_role='0'";

            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($value_query = mysqli_fetch_assoc($result)) {
                    $user_id = $value_query["user_id"];
                    $user_name = $value_query["user_name"];
                    $user_password = $value_query["user_password"];
                    $user_email = $value_query["user_email"];
                    $user_nmri = $value_query["user_nmri"];
                    $user_document_type = $value_query["doc_id"];
                    $user_change_pw = $value_query["user_change_pw"];
                    $user_key = $value_query["user_key"];
                    $user_role = $value_query["user_role"];
                }

//GUARDA NA SESSÃO OS DADOS DO UTILIZADOR
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_password'] = $user_password;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_nmri'] = $user_nmri;
                $_SESSION['doc_id'] = $user_document_type;
                $_SESSION['user_change_pw'] = $user_change_pw;
                $_SESSION['user_key'] = $user_key;
                $_SESSION['user_role'] = $user_role;
                $user_logged = true;
                echo $user_logged;
            } else {
                header('Location: https://voto-eletronico.jbr-projects.pt');
            }
        }
    }
}

//FUNÇÃO QUE ENVIA AO UTILIZADOR UMA CHAVE NOVA
function resend_key() {
    include '../application/Db_connection.php';
    include '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['user_document_type']) && isset($_POST['user_password']) && isset($_POST['user_nmri'])) {
            $user_document_type = $_POST['user_document_type'];
            $user_password = $_POST['user_password'];
            $user_nmri = $_POST['user_nmri'];
            $user_password = utf8_decode($user_password);
            $user_password = md5($user_password);
            $query = "SELECT * FROM users WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                $user_key = md5(microtime() . rand());
                $query_insert = "UPDATE users SET user_key='$user_key' WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";
                $query_get_email = "SELECT * FROM users WHERE user_nmri='$user_nmri' AND user_password='$user_password' AND doc_id='$user_document_type' AND user_role='0'";
                $result_insert = mysqli_query($connection, $query_insert);
                $result_after = mysqli_query($connection, $query_get_email);

//select à bd para receber as informações do utilizador que está a tentar fazer o login
                while ($value_query = mysqli_fetch_assoc($result_after)) {
                    $user_email = $value_query["user_email"];
                    $user_key = $value_query["user_key"];
                }
                $message = file_get_contents('../application/email.php');
                $info_email = utf8_decode("A sua nova chave de segurança para iniciar sessão em voto-eletronico.jbr-projects.pt: <br><br>$user_key");
                $message = str_replace('%info_email%', $info_email, $message);
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'yourhost';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourusername';
                $mail->Password = 'yourpassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                $mail->addAddress($user_email);

                $mail->isHTML(true);
                $mail->Subject = utf8_decode('Nova palavra-chave de segurança para iniciar a sessão');
                $mail->MsgHTML($message);
                $mail->AltBody = utf8_decode("A sua nova chave de segurança para iniciar sessao em voto-eletronico.jbr-projects.pt: $user_key");

//ENVIAR AO EMAIL AO UTILIZADOR COM A KEY
                if (!$mail->send()) {
                    $mail->ErrorInfo;
                }
            }
        }
    }
}

//FUNÇÃO QUE ENVIA EMAIL AO UTILIZADOR COM O LINK PARA RECUPERAR A PASSWORD
function send_email_recoverpw() {
    include '../application/Db_connection.php';
    include '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $result = mysqli_query($connection, "SELECT * FROM users WHERE user_email='" . $email . "' AND user_role='0'");
            if (mysqli_num_rows($result) > 0) {
                $user_key = md5(microtime() . rand());
                $expFormat = mktime(
                        date("H") + 1, date("i"), date("s"), date("m"), date("d"), date("Y")
                );
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $update = mysqli_query($connection, "UPDATE users SET user_key='" . $user_key . "' ,user_exp_pw_date='" . $expDate . "' WHERE user_email='" . $email . "' AND user_role='0'");
                $user_role = 0;
                $link = "https://voto-eletronico.jbr-projects.pt/application/reset-password.php?email=" . $email . "&role=" . $user_role . "&key=" . $user_key . "";

                $doc_name = utf8_encode($doc_name);
                $message = file_get_contents('../application/email.php');
                $info_email = utf8_decode("Aceda ao link em baixo para alterar a sua password: <br><br> ") . $link;
                $message = str_replace('%info_email%', $info_email, $message);

                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'yourhost';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourusername';
                $mail->Password = 'yourpassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = utf8_decode('Link para recuperar a password');
                $mail->MsgHTML($message);
                $mail->AltBody = utf8_decode("Aceda ao link para alterar a sua password: $link");

//ENVIAR AO EMAIL AO UTILIZADOR COM A KEY
                if (!$mail->send()) {
                    $mail->ErrorInfo;
                }
                $email_found = true;
            } else {
                $email_found = false;
            }
        }
    }
    echo $email_found;
}

//FUNÇÃO QUE ALTERA A PASSWORD
function recover_pw() {
    include '../application/Db_connection.php';
    $changed = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email']) && isset($_POST['role']) && isset($_POST['key']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $role = $_POST['role'];
            $key = $_POST['key'];
            $password = $_POST['password'];
            $password = md5($password);
            $result = mysqli_query($connection, "UPDATE users set  user_password='" . $password . "', user_exp_pw_date='" . NULL . "' WHERE user_key='" . $key . "' AND user_email='" . $email . "' AND user_role='" . $role . "'");
            $changed = true;
        }
    }
    echo $changed;
}

//FUNÇÃO QUE FAZ LOGOUT AO UTILIZADOR
function logout_user() {
    session_destroy();
    header('Location: https://voto-eletronico.jbr-projects.pt');
}

//FUNÇÃO QUE VAI BUSCAR OS TIPOS DE DOCUMENTOS
function get_docs() {
    include 'application/Db_connection.php';
    $query_docs = "SELECT * FROM document_type";
    $result_docs = mysqli_query($connection, $query_docs);
    return $result_docs;
}

//ALTERA A PALAVRA PASSE DO UTILIZADOR QUANDO ELE FAZ O PRIMEIRO LOGIN
function set_change_pw() {
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        if (isset($_POST['user_password'])) {
            $user_id = $_SESSION['user_id'];
            $user_password = $_POST['user_password'];
            $user_password = utf8_decode($user_password);
            $user_password = md5($user_password);

            $query = "UPDATE users SET user_password='$user_password', user_change_pw='1' WHERE user_id = '$user_id'";
            if (mysqli_query($connection, $query)) {
                $_SESSION['user_password'] = $user_password;
                $_SESSION['user_change_pw'] = 1;
                $updated = true;
                echo $updated;
            }
        }
    }
}

//FUNÇAO QUE VERIFICA SE A PASSWORD INSERIDA CORRESPONDE À ATUAL
function verify_pw_user() {
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $exists = false;
        if (isset($_POST['user_password'])) {
            $user_id = $_SESSION['user_id'];
            $user_password = $_POST['user_password'];
            $user_password = utf8_decode($user_password);
            $user_password = md5($user_password);

            $query = "SELECT * FROM users WHERE user_id='$user_id' AND user_password ='$user_password'";
            $result_password = mysqli_query($connection, $query);
            if(mysqli_num_rows($result_password) > 0){
                $exists = true;
            }
            echo $exists;
            
        }
    }
}

//FUNÇAO QUE ALTERA A PASSWORD
function user_new_password(){
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        if (isset($_POST['user_new_password'])) {
            $user_id = $_SESSION['user_id'];
            $user_new_password = $_POST['user_new_password'];
            $user_new_password = utf8_decode($user_new_password);
            $user_new_password = md5($user_new_password);

             $query = "UPDATE users SET user_password='$user_new_password' WHERE user_id = '$user_id'";
            if (mysqli_query($connection, $query)) {
                $_SESSION['user_password'] = $user_new_password;
                $updated = true;
                echo $updated;
            }
            
        }
    }
} 

//FUNÇÃO QUE VAI BUSCAR OS EVENTOS COM UM DETERMINADO TIPO DE DOCUMENTO
function get_event_users() {
    include 'application/Db_connection.php';
    $doc_id = $_SESSION['doc_id'];
    $query_event_user = "SELECT * FROM events WHERE doc_id='$doc_id'";
    $result_event_user = mysqli_query($connection, $query_event_user);
    return $result_event_user;
}

//FUNÇÃO QUE RETORNA EM FORMATO JSON PARA JQUERY TODOS OS CANDIDATOS POSSIVEIS PARA VOTAR
function get_candidates_event_fjson() {
    include '../application/Db_connection.php';
//VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];
            $query_candidates_event = "SELECT * FROM events_candidates as ec INNER JOIN candidates as c ON ec.candidate_id=c.candidate_id AND  ec.event_id = '$event_id' ORDER BY c.candidate_name ASC ,c.candidate_entourage ASC ";
            $result_candidates_event = mysqli_query($connection, $query_candidates_event);
            $i = 0;
            if (mysqli_num_rows($result_candidates_event) > 0) {
                while ($value_query = mysqli_fetch_assoc($result_candidates_event)) {
                    $candidate_id = $value_query["candidate_id"];
                    $candidate_name = $value_query["candidate_name"];
                    $candidate_entourage = $value_query["candidate_entourage"];
                    $candidate_name = utf8_encode($candidate_name);
                    $candidate_entourage = utf8_encode($candidate_entourage);
                    //CRIA UM ARRAY COM OS DADOS DE TODOS OS CANDIDATOS
                    $array[$i] = array(
                        'candidate_id' => $candidate_id,
                        'candidate_name' => $candidate_name,
                        'candidate_entourage' => $candidate_entourage,
                    );
                    $i++;
                }
                echo json_encode($array, JSON_UNESCAPED_UNICODE);
            }
        }
    }
}

//FUNÇÃO QUE GUARDA O VOTO DE UM UTILIZADOR NUM EVENTO NUM DETERMINADO CANDIDATO
function save_vote() {
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['event_id']) && isset($_POST['candidate_id'])) {
            $insert = false;
            $user_id = $_SESSION['user_id'];
            $event_id = $_POST['event_id'];
            $candidate_id = $_POST['candidate_id'];
            $vote_key = md5(microtime() . rand());
            $query = "INSERT INTO votes(user_id, event_id, candidate_id, vote_key) VALUES ('$user_id', '$event_id','$candidate_id', '$vote_key')";
            if (mysqli_query($connection, $query)) {
                $user_email = $_SESSION['user_email'];
                if ($candidate_id == 0) {
                    $query_vote = "SELECT * FROM votes as v JOIN events as e WHERE v.event_id=e.event_id AND v.user_id='$user_id'";
                    $result_vote = mysqli_query($connection, $query_vote);
                    if (mysqli_num_rows($result_vote) > 0) {
                        while ($value_query = mysqli_fetch_assoc($result_vote)) {
                            $event_title = $value_query["event_title"];
                            $event_title = utf8_encode($event_title);
                        }

                        $message = file_get_contents('../application/email.php');
                        $info_email = utf8_decode("O seu voto foi submetido com sucesso em voto-eletronico.jbr-projects.pt: <br><br>Dados do Voto: <br><br>Título do Evento: $event_title <br><br>Nome do Candidato:  Voto em Branco <br><br>Código de voto: $vote_key ");
                        $message = str_replace('%info_email%', $info_email, $message);
                        $mail = new PHPMailer;

                        $mail->isSMTP();
                $mail->Host = 'yourhost';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourusername';
                $mail->Password = 'yourpassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                        $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                        $mail->addAddress($user_email);

                        $mail->isHTML(true);
                        $mail->Subject = utf8_decode('Confirmação dos Dados do Voto');
                        $mail->MsgHTML($message);
                        $mail->AltBody = utf8_decode("O seu voto foi submetido com sucesso em voto-eletronico.jbr-projects.pt: Dados do Voto: Título do Evento: $event_title, Nome do Candidato: Voto em Branco, Código de voto: $vote_key ");

//ENVIAR AO EMAIL AO UTILIZADOR COM OS DETALHES DO VOTO
                        if (!$mail->send()) {
                            $mail->ErrorInfo;
                        }
                        $insert = true;
                        echo $insert;
                    }
                } else {
                    $query_vote = "SELECT * FROM votes as v JOIN events as e JOIN candidates as c WHERE v.event_id=e.event_id AND v.candidate_id=c.candidate_id AND v.user_id='$user_id'";
                    $result_vote = mysqli_query($connection, $query_vote);
                    if (mysqli_num_rows($result_vote) > 0) {
                        while ($value_query = mysqli_fetch_assoc($result_vote)) {
                            $candidate_name = $value_query["candidate_name"];
                            $candidate_entourage = $value_query["candidate_entourage"];
                            $candidate_name = utf8_encode($candidate_name);
                            $candidate_entourage = utf8_encode($candidate_entourage);
                            $event_title = $value_query["event_title"];
                            $event_title = utf8_encode($event_title);
                        }

                        if ($candidate_name == '') {
                            $message = file_get_contents('../application/email.php');
                            $info_email = utf8_decode("O seu voto foi submetido com sucesso em voto-eletronico.jbr-projects.pt: <br><br>Dados do Voto: <br><br>Título do Evento: $event_title <br><br>Nome do Candidato: $candidate_entourage <br><br>Código de voto: $vote_key ");
                            $message = str_replace('%info_email%', $info_email, $message);
                        } else {
                            $message = file_get_contents('../application/email.php');
                            $info_email = utf8_decode("O seu voto foi submetido com sucesso em voto-eletronico.jbr-projects.pt: <br><br>Dados do Voto: <br><br>Título do Evento: $event_title <br><br>Nome do Candidato: $candidate_name <br><br>Código de voto: $vote_key ");
                            $message = str_replace('%info_email%', $info_email, $message);
                        }

                        $mail = new PHPMailer;

                        $mail->isSMTP();
                $mail->Host = 'yourhost';
                $mail->SMTPAuth = true;
                $mail->Username = 'yourusername';
                $mail->Password = 'yourpassword';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                        $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                        $mail->addAddress($user_email);

                        $mail->isHTML(true);
                        $mail->Subject = utf8_decode('Confirmação dos Dados do Voto');
                        $mail->MsgHTML($message);
                        


//ENVIAR AO EMAIL AO UTILIZADOR COM OS DETALHES DO VOTO
                        if (!$mail->send()) {
                            $mail->ErrorInfo;
                        }
                        $insert = true;
                        echo $insert;
                    }
                }
            }
        }
    }
}

//VERIFICAÇÃO SE O UTILIZADOR JÁ VOTOU NUM DETERMINADO EVENTO
function check_vote($event_id) {
    include 'application/Db_connection.php';
    $user_id = $_SESSION['user_id'];
    $query_vote = "SELECT * FROM votes WHERE event_id='$event_id' AND user_id='$user_id'";
    $result_vote = mysqli_query($connection, $query_vote);
    if (mysqli_num_rows($result_vote) > 0) {
        return true;
    } else {
        return false;
    }
}

//VER RESULTADOS DE UM EVENTO
function see_results() {
    include '../application/Db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];
            $query = "SELECT doc_id FROM events WHERE event_id ='$event_id'";
            $result_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $event_doc = $row['doc_id'];
            }
            $query_count_votes = "SELECT * FROM votes WHERE event_id='$event_id'";
            $result_count_votes = mysqli_query($connection, $query_count_votes);
            $n_votos = mysqli_num_rows($result_count_votes);
            $query_n_registed_users = "SELECT * FROM users AS u LEFT OUTER JOIN events AS e ON u.doc_id=e.doc_id WHERE e.doc_id='$event_doc' AND event_id='$event_id'";
            $result_n_registed_users = mysqli_query($connection, $query_n_registed_users);
            $n_all_users = mysqli_num_rows($result_n_registed_users);
            $no_votes = $n_all_users - $n_votos;
            $query = "SELECT c.candidate_id, c.candidate_name,c.candidate_entourage, COUNT(*) AS n_votos FROM votes as v LEFT JOIN candidates as c ON c.candidate_id=v.candidate_id WHERE event_id='$event_id' GROUP BY v.candidate_id ORDER BY n_votos DESC";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) >= 0) {
                $output .= '
                        <table class="table" bordered="1">  
                        <tr>  
                        <th>Nome do Candidato</th>  
                        <th>Partido do Candidato</th>  
                        <th>Número de Votos</th>
                        </tr>';
                while ($row = mysqli_fetch_array($result)) {
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
                }
                $output .= '
                        <tr>  
                        <td>Votos nulos</td>  
                        <td>-----------------</td>  
                        <td>' . $no_votes . '</td>
                        </tr>';
                $output .= '</table>';
                echo $output;
            }
        }
    }
}
