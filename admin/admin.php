<?php

require '../application/Db_connection.php';
include '../application/PHPMailer-5.2-stable/PHPMailerAutoload.php';


session_start();

//VERIFICA SE ALGUEM ESTÁ A ACEDER A ESTE FICHEIRO PELO MÉTODO GET, CASO ESTEJA A FAZER REDIRECIONA PARA A PÁGINA DE ADMINISTRADOR
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('Location: https://voto-eletronico.jbr-projects.pt/admin');
}

//RECEBE O NOME DA FUNÇÃO PELO MÉTODO GET, VERIFICA SE ELA EXISTE E ENTRA NA MESMA
$function = $_GET['f'];
if (function_exists($function)) {
    call_user_func($function);
}

//FUNÇÃO PARA LOGIN DO ADMINISTRADOR
function login_admin() {
    include '../application/Db_connection.php';
    //SE O UTILIZADOR NO URL FIZER /ADMIN E DE SEGUIDA TENTAR ENTRAR COM A SUA CONTA DE ADMIN ELE FAZ UNSET À SESSION DOS DETALHES DIFERENTES QUE O UTILIZADOR TEM
    unset($_SESSION['user_nmri'], $_SESSION['doc_id'], $_SESSION['user_change_pw'], $_SESSION['user_key']);
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //VÁRIAVEL QUE RETORNA PARA O JQUERY SE O ADMIN FEZ LOGIN OU NÃO
        $admin_logged = false;
        //VARIÁVEL QUE VERIFICA SE EXISTE OU NÃO O ADMIN
        $_SESSION['no_result'] = false;
        if (isset($_POST['admin_email']) && isset($_POST['admin_password'])) {
            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_password'];
            $admin_password = md5($admin_password);
            $query = "SELECT * from users WHERE user_email='$admin_email' AND user_password='$admin_password' AND user_role='1'";
            $result = mysqli_query($connection, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($value_query = mysqli_fetch_assoc($result)) {
                    $admin_name = $value_query["user_name"];
                    $admin_email = $value_query["user_email"];
                    $admin_password = $value_query["user_password"];
                    $user_role = $value_query["user_role"];
                }

                //GUARDA NA SESSÃO OS DADOS DO UTILIZADOR
                $_SESSION['user_name'] = $admin_name;
                $_SESSION['user_email'] = $admin_email;
                $_SESSION['user_password'] = $admin_password;
                $_SESSION['user_role'] = $user_role;

                //VARIAVEL QUE DIZ AO JQUERY QUE O ADMIN FEZ LOGIN
                $admin_logged = true;
                echo $admin_logged;
            } else {
                $_SESSION['no_result'] = true;
                header('Location: https://voto-eletronico.jbr-projects.pt/admin/');
            }
        }
    }
}

//FUNÇÃO QUE FAZ LOGOUT AO ADMIN
function logout_admin() {
    session_destroy();
    header('Location: https://voto-eletronico.jbr-projects.pt/admin/');
}

//FUNÇÃO QUE ENVIA EMAIL AO UTILIZADOR COM O LINK PARA RECUPERAR A PASSWORD
function send_email_recoverpw() {
    include '../application/Db_connection.php';
    include '../PHPMailer-5.2-stable/PHPMailerAutoload.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $result = mysqli_query($connection, "SELECT * FROM users WHERE user_email='" . $email . "' AND user_role='1'");
            if (mysqli_num_rows($result) > 0) {
                $user_key = md5(microtime() . rand());
                $expFormat = mktime(
                        date("H") + 1, date("i"), date("s"), date("m"), date("d"), date("Y")
                );
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $update = mysqli_query($connection, "UPDATE users SET user_key='" . $user_key . "' ,user_exp_pw_date='" . $expDate . "' WHERE user_email='" . $email . "' AND user_role='1'");
                $user_role = 1;
                $link = "https://voto-eletronico.jbr-projects.pt/application/reset-password.php?email=" . $email . "&role=" . $user_role . "&key=" . $user_key . "";

                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host = 'voto-eletronico.jbr-projects.pt';
                $mail->SMTPAuth = true;
                $mail->Username = 'geral@voto-eletronico.jbr-projects.pt';
                $mail->Password = 'voto_hj12345';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = utf8_decode('Link para recuperar a password');
                $mail->Body = utf8_decode("Aceda ao link em baixo para alterar a sua password: <br><br> ") . $link;
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

//FUNÇÃO QUE INSERE UM NOVO UTILIZADOR
function add_user() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_registed = false;
        //VERIFICA SE EXISTE O POST DE TODAS AS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['add_user_name']) && isset($_POST['add_user_email']) && isset($_POST['add_user_password']) && isset($_POST['add_user_doc']) && isset($_POST['add_user_nmri'])) {

            $add_user_name = $_POST['add_user_name'];
            $add_user_name = utf8_decode($add_user_name);
            $add_user_email = $_POST['add_user_email'];
            $add_user_password = $_POST['add_user_password'];
            $add_user_password = utf8_decode($add_user_password);
            $user_password_wihtoumd5 = $add_user_password;
            $add_user_password = md5($add_user_password);
            $add_user_doc = $_POST['add_user_doc'];
            $add_user_doc = utf8_decode($add_user_doc);
            $add_user_nmri = $_POST['add_user_nmri'];
            $query_select_nmri = "SELECT user_nmri FROM users WHERE user_nmri = '$add_user_nmri' AND user_role='0' AND doc_id = '$add_user_doc'";
            $query_select_email = "SELECT user_email FROM users WHERE user_email = '$add_user_email' AND user_role='0'";
            $result_nmri = mysqli_query($connection, $query_select_nmri);
            $result_email = mysqli_query($connection, $query_select_email);

            //VERIFICAÇÕES SE JÁ EXISTE UM UTILIZADOR COM O MESMO EMAIL OU COM O MESMO NUMERO DE IDENTIFICAÇÃO
            if (mysqli_num_rows($result_nmri) > 0) {
                //VARIAVEL QUE DIZ AO JQUERY QUE EXISTE UM UTILIZADOR COM O MESMO NUMERO DE IDENTIFICAÇÃO
                $user_registed = true;
                echo $user_registed;
            } else if (mysqli_num_rows($result_email) > 0) {
                //VARIAVEL QUE DIZ AO JQUERY QUE EXISTE UM UTILIZADOR COM O MESMO EMAIL
                $user_registed = true;
                echo $user_registed;
            } else {

                $query = "INSERT INTO users (user_name, user_password, user_email, doc_id, user_nmri, user_role)
                        VALUES ('$add_user_name','$add_user_password', '$add_user_email', '$add_user_doc', '$add_user_nmri','0')";
                $result = mysqli_query($connection, $query);

                $query_doc = "SELECT * FROM document_type as dc WHERE dc.doc_id='$add_user_doc'";
                $result_doc = mysqli_query($connection, $query_doc);
                if (mysqli_num_rows($result_doc) > 0) {
                    while ($value_query = mysqli_fetch_assoc($result_doc)) {
                        $doc_name = $value_query["doc_name"];
                    }
                    $doc_name = utf8_encode($doc_name);
                    $message = file_get_contents('../application/email.php');
                    $info_email = utf8_decode("Dados para iniciar sessão em voto-eletronico.jbr-projects.pt: <br><br>Tipo de Documento: $doc_name <br><br> Número de Identificação: $add_user_nmri <br><br> Password: $user_password_wihtoumd5");
                    $message = str_replace('%info_email%', $info_email, $message);
                    $mail = new PHPMailer;

                    $mail->isSMTP();
                    $mail->Host = 'voto-eletronico.jbr-projects.pt';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'geral@voto-eletronico.jbr-projects.pt';
                    $mail->Password = 'voto_hj12345';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('no-reply@voto-eletronico.jbr-projects.pt', 'NO-REPLY - VOTO ELETRONICO');
                    $mail->addAddress($add_user_email);

                    $mail->isHTML(true);
                    $mail->Subject = utf8_decode('Dados para iniciar a sessão');
                    $mail->MsgHTML($message);
                    $mail->AltBody = utf8_decode("Dados para iniciar sessao em voto-eletronico.jbr-projects.pt: Tipo de Documento: $doc_name, Número de Identificação: $add_user_nmri, Password: $user_password_wihtoumd5");

                    //ENVIAR AO EMAIL AO UTILIZADOR COM A KEY
                    if (!$mail->send()) {
                        $mail->ErrorInfo;
                    }
                }
            }
        }
    }
}

//FUNÇÃO QUE ELIMINA O UTILIZADOR
function delete_user() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_deleted = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $query = "DELETE FROM users WHERE user_id = '$user_id'";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE DIZ AO JQUERY QUE O UTILIZADOR FOI ELIMINADO
                $user_deleted = true;
                echo $user_deleted;
            }
        }
    }
}

//FUNÇÃO QUE ADICIONA UM EVENTO
function add_event() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $added = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['add_event_title']) && isset($_POST['add_event_description']) && isset($_POST['add_event_date_ini']) && isset($_POST['add_event_date_exp']) && isset($_POST['add_event_doc'])) {
            $add_event_title = $_POST['add_event_title'];
            $add_event_title = utf8_decode($add_event_title);
            $add_event_date_ini = $_POST['add_event_date_ini'];
            $add_event_date_exp = $_POST['add_event_date_exp'];
            $add_event_description = $_POST['add_event_description'];
            $add_event_description = utf8_decode($add_event_description);
            $add_event_doc = $_POST['add_event_doc'];
            $add_event_doc = utf8_decode($add_event_doc);
            //VERIFICA SE O POST DA DESCRIÇÃO ESTÁ VAZIO
            if ($add_event_description == '') {
                $query = "INSERT INTO events (event_title, event_date_ini, event_date_exp, doc_id)
        VALUES ('$add_event_title', '$add_event_date_ini', '$add_event_date_exp','$add_event_doc')";
            } else {
                $query = "INSERT INTO events (event_title, event_description, event_date_ini, event_date_exp, doc_id)
        VALUES ('$add_event_title', '$add_event_description', '$add_event_date_ini', '$add_event_date_exp','$add_event_doc')";
            }
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE DIZ AO JQUERY QUE O EVENTO FOI ADICIONADO
                $added = true;
                echo $added;
            }
        }
    }
}

//FUNÇÃO QUE ELIMINA UM DETERMINADO EVENTO
function delete_event() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event_deleted = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];
            $query = "DELETE FROM events WHERE event_id = '$event_id'";
            $query2 = "DELETE FROM events_candidates WHERE event_id = '$event_id'";
            $query3 = "DELETE FROM votes WHERE event_id='$event_id'";
            if (mysqli_query($connection, $query)) {
                if (mysqli_query($connection, $query2)) {
                    if (mysqli_query($connection, $query3)) {
                        //VARIAVEL QUE DIZ AO JQUERY QUE O EVENTO FOI ELIMINADO
                        $event_deleted = true;
                        echo $event_deleted;
                    }
                }
            }
        }
    }
}

//FUNÇÃO QUE ADICIONA UM NOVO CANDIDATO
function add_candidate() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $added = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['add_candidate_name']) && isset($_POST['add_candidate_entourage'])) {
            $add_candidate_name = $_POST['add_candidate_name'];
            $add_candidate_name = utf8_decode($add_candidate_name);
            $add_candidate_entourage = $_POST['add_candidate_entourage'];
            $add_candidate_entourage = utf8_decode($add_candidate_entourage);
            $added = false;
            //VERIFICA SE O CANDIDATO TEM NOME OU TEM PARTIDO OU TEM OS DOIS
            if ($add_candidate_entourage == '') {
                $query = "INSERT INTO candidates (candidate_name)
        VALUES ('$add_candidate_name')";
            } else if ($add_candidate_name == '') {
                $query = "INSERT INTO candidates (candidate_entourage)
        VALUES ('$add_candidate_entourage')";
            } else {
                $query = "INSERT INTO candidates (candidate_name, candidate_entourage)
        VALUES ('$add_candidate_name', '$add_candidate_entourage')";
            }
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE DIZ AO JQUERY QUE O CANDIDATO FOI ADICIONADO
                $added = true;
                echo $added;
            }
        }
    }
}

//FUNÇÃO QUE ELIMINA UM DETERMINADO CANDIDATO
function delete_candidate() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $candidate_deleted = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['candidate_id'])) {
            $candidate_id = $_POST['candidate_id'];
            $query = "DELETE FROM candidates WHERE candidate_id = '$candidate_id'";
            $query2 = "DELETE FROM events_candidates WHERE candidate_id = '$candidate_id'";
            if (mysqli_query($connection, $query)) {
                if (mysqli_query($connection, $query2)) {
                    //VARIAVEL QUE DIZ AO JQUERY QUE O CANDIDATO FOI ELIMINADO
                    $candidate_deleted = true;
                    echo $candidate_deleted;
                }
            }
        }
    }
}

//FUNÇÃO QUE ADICIONA UM TIPO DE DOCUMENTO
function add_document_type() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $added = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['add_document_name'])) {
            $add_document_name = $_POST['add_document_name'];
            $add_document_name = utf8_decode($add_document_name);
            $query = "INSERT INTO document_type (doc_name) VALUES ('$add_document_name')";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE DIZ AO JQUERY QUE O TIPO DE DOCUMENTO FOI ADICIONADO
                $added = true;
                echo $added;
            }
        }
    }
}

//FUNÇÃO QUE ELIMINA UM TIPO DE DOCUMENTO
function delete_doc() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $doc_deleted = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['doc_id'])) {
            $doc_id = $_POST['doc_id'];
            $query = "DELETE FROM document_type WHERE doc_id = '$doc_id'";
            $query2 = "DELETE FROM users WHERE doc_id = '$doc_id'";
            if (mysqli_query($connection, $query)) {
                if (mysqli_query($connection, $query2)) {
                    //VARIAVEL QUE DIZ AO JQUERY QUE O TIPO DE DOCUMENTO FOI ELIMINADO
                    $doc_deleted = true;
                    echo $doc_deleted;
                }
            }
        }
    }
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS EVENTOS
function get_events() {
    include '../application/Db_connection.php';
    $query_events = "SELECT * FROM events as e JOIN document_type as d WHERE e.doc_id=d.doc_id ORDER BY event_id DESC";
    $result_event = mysqli_query($connection, $query_events);
    return $result_event;
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS UTILIZADORES
function get_users() {
    include '../application/Db_connection.php';
    $query_users = "SELECT * FROM users as u JOIN document_type as d WHERE u.doc_id=d.doc_id ORDER BY user_id DESC";
    $result_users = mysqli_query($connection, $query_users);
    return $result_users;
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS CANDIDATOS
function get_candidates() {
    include '../application/Db_connection.php';
    $query_candidates = "SELECT * FROM candidates ORDER BY candidate_id DESC";
    $result_candidates = mysqli_query($connection, $query_candidates);
    return $result_candidates;
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS TIPOS DE DOCUMENTOS
function get_docs() {
    include '../application/Db_connection.php';
    $query_docs = "SELECT * FROM document_type ORDER BY doc_id DESC";
    $result_docs = mysqli_query($connection, $query_docs);
    return $result_docs;
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS DOCUMENTOS E RETORNAR PARA O JQUERY EM FORMATO JSON - DE FORMA A APARECER O NOME DO DOCUMENTO NO SELECT PARA EDITAR EVENTO E UTILIZADOR
function get_docs_fjson() {
    include '../application/Db_connection.php';
    $query_docs = "SELECT * FROM document_type ORDER BY doc_id DESC";
    $result_docs = mysqli_query($connection, $query_docs);
    $i = 0;
    if (mysqli_num_rows($result_docs) > 0) {
        while ($value_query = mysqli_fetch_assoc($result_docs)) {
            $doc_id = $value_query["doc_id"];
            $doc_name = $value_query["doc_name"];
            $doc_name = utf8_encode($doc_name);
            //CRIA UM ARRAY COM TODOS OS DADOS DOS TIPOS DE DOCUMENTO
            $array[$i] = array(
                'doc_id' => $doc_id,
                'doc_name' => $doc_name,
            );
            $i++;
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

//FUNÇÃO QUE VAI BUSCAR UM UTILIZADOR ESPECIFICO E RETORNA PARA O JQUERY EM FORMATO JSON
function get_specific_user() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
            $query_users = "SELECT * FROM users as u JOIN document_type as d WHERE u.doc_id=d.doc_id AND u.user_id='$user_id'";
            $result_user = mysqli_query($connection, $query_users);
            if (mysqli_num_rows($result_user) > 0) {
                while ($value_query = mysqli_fetch_assoc($result_user)) {
                    $user_name = $value_query["user_name"];
                    $user_email = $value_query["user_email"];
                    $user_nmri = $value_query["user_nmri"];
                    $user_doc_id = $value_query["doc_id"];
                }
                $user_name = utf8_encode($user_name);
                //CRIA UM ARRAY COM OS DADOS DE UM UTILIZADOR
                $array = array(
                    'user_name' => $user_name,
                    'user_email' => $user_email,
                    'user_nmri' => $user_nmri,
                    'user_doc_id' => $user_doc_id
                );
            }
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
        }
    }
}

//FUNÇÃO QUE EDITA OS DADOS DE UM CERTO UTILIZADOR
function edit_user() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['user_email']) && isset($_POST['user_nmri']) && isset($_POST['doc_id'])) {
            $user_id = $_POST['user_id'];
            $user_name = $_POST['user_name'];
            $user_name = utf8_decode($user_name);
            $user_email = $_POST['user_email'];
            $user_nmri = $_POST['user_nmri'];
            $user_doc_id = $_POST['doc_id'];
            $query_select_email = "SELECT user_email FROM users WHERE user_email = '$user_email' AND user_role='0' AND user_id != '$user_id'";
            $result_email = mysqli_query($connection, $query_select_email);
            $query_select_nmri = "SELECT user_nmri FROM users WHERE user_nmri = '$user_nmri' AND user_role='0' AND doc_id = '$user_doc_id' AND user_id != '$user_id'";
            $result_nmri = mysqli_query($connection, $query_select_nmri);

            //VERIFICAÇÕES SE JÁ EXISTE UM UTILIZADOR COM O MESMO EMAIL OU COM O MESMO NUMERO DE IDENTIFICAÇÃO
            if (mysqli_num_rows($result_nmri) > 0) {
                //VARIAVEL QUE DIZ AO JQUERY QUE EXISTE UM UTILIZADOR COM O MESMO NUMERO DE IDENTIFICAÇÃO
                $updated = false;
                echo $updated;
            } else if (mysqli_num_rows($result_email) > 0) {
                //VARIAVEL QUE DIZ AO JQUERY QUE JÁ EXISTE UM UTILIZADOR COM O MESMO EMAIL
                $updated = false;
                echo $updated;
            } else {
                $query = "UPDATE users SET user_name='$user_name', user_email='$user_email', user_nmri='$user_nmri', doc_id='$user_doc_id' WHERE user_id='$user_id'";
                if (mysqli_query($connection, $query)) {
                    //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O UTILIZADOR FOI EDITADO
                    $updated = true;
                    echo $updated;
                }
            }
        }
    }
}

//FUNÇÃO QUE VAI BUSCAR UM EVENTO ESPECIFICO E RETORNA PARA O JQUERY EM FORMATO JSON
function get_specific_event() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['event_id'])) {
            $event_id = $_POST['event_id'];
            $query_event = "SELECT * FROM events as e JOIN document_type as d WHERE e.doc_id=d.doc_id AND e.event_id='$event_id'";
            $result_event = mysqli_query($connection, $query_event);
            if (mysqli_num_rows($result_event) > 0) {
                while ($value_query = mysqli_fetch_assoc($result_event)) {
                    $event_title = $value_query["event_title"];
                    $event_description = $value_query["event_description"];
                    $event_date_ini = $value_query["event_date_ini"];
                    $event_date_exp = $value_query["event_date_exp"];
                    $event_doc_id = $value_query["doc_id"];
                }
                $event_title = utf8_encode($event_title);
                $event_description = utf8_encode($event_description);
                //CRIA UM ARRAY COM OS DADOS DE UM EVENTO
                $array = array(
                    'event_title' => $event_title,
                    'event_description' => $event_description,
                    'event_date_ini' => $event_date_ini,
                    'event_date_exp' => $event_date_exp,
                    'event_doc_id' => $event_doc_id
                );
            }
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
        }
    }
}

//FUNÇÃO QUE EDITA OS DADOS DE UM CERTO EVENTO
function edit_event() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['event_id']) && isset($_POST['event_title']) && isset($_POST['event_description']) && isset($_POST['event_date_ini']) && isset($_POST['event_date_exp']) && isset($_POST['doc_id'])) {
            $event_id = $_POST['event_id'];
            $event_title = $_POST['event_title'];
            $event_title = utf8_decode($event_title);
            $event_description = $_POST['event_description'];
            $event_description = utf8_decode($event_description);
            $event_date_ini = $_POST['event_date_ini'];
            $event_date_exp = $_POST['event_date_exp'];
            $event_doc_id = $_POST['doc_id'];
            $query = "UPDATE events SET event_title='$event_title', event_description='$event_description', event_date_ini='$event_date_ini', event_date_exp='$event_date_exp', doc_id='$event_doc_id' WHERE event_id='$event_id'";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O EVENTO FOI EDITADO
                $updated = true;
                echo $updated;
            }
        }
    }
}

//FUNÇÃO QUE VAI BUSCAR TODOS OS CANDIDATOS E RETORNAR PARA O JQUERY EM FORMATO JSON - DE FORMA A APARECER O NOME DOS CANDIDATOS NO SELECT PARA ADICIONAR UM CANDIDATO AO EVENTO
function get_candidates_fjson() {
    include '../application/Db_connection.php';
    $query_candidate = "SELECT * FROM candidates ORDER BY candidate_id DESC";
    $result_candidate = mysqli_query($connection, $query_candidate);
    $i = 0;
    if (mysqli_num_rows($result_candidate) > 0) {
        while ($value_query = mysqli_fetch_assoc($result_candidate)) {
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

//FUNÇÃO QUE ADICIONA O CANDIDATO AO EVENTO
function add_candidate_event() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['candidate_id']) && isset($_POST['event_id'])) {
            $candidate_id = $_POST['candidate_id'];
            $event_id = $_POST['event_id'];
            $query = "INSERT INTO events_candidates (event_id, candidate_id) VALUES ('$event_id', '$candidate_id')";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O CANDIDATO FOI INSERIDO AO EVENTO
                $updated = true;
                echo $updated;
            }
        }
    }
}

//FUNÇÃO QUE VERIFICA OS CANDIDATOS ADICIONADOS A UM EVENTO E RETORNA PARA O JQUERY EM FORMATO JSON - DE FORMA A NÃO SER POSSIVEL ADICIONAR O MESMO CANDIDATO AO MESMO EVENTO
function confirm_candidate_added_event() {
    include '../application/Db_connection.php';
    $query = "SELECT * FROM events_candidates";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) >= 0) {
        while ($value_query = mysqli_fetch_assoc($result)) {
            $event_id = $value_query["event_id"];
            $candidate_id = $value_query["candidate_id"];
            //CRIA UM ARRAY COM OS IDS DO EVENTO E DO CANDIDATO
            $array[$i] = array(
                'event_id' => $event_id,
                'candidate_id' => $candidate_id,
            );
            $i++;
        }
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
    }
}

//FUNÇÃO QUE VAI BUSCAR UM CANDIDATO ESPECIFICO E RETORNA PARA O JQUERY EM FORMATO JSON
function get_specific_candidate() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['candidate_id'])) {
            $candidate_id = $_POST['candidate_id'];
            $query_candidate = "SELECT * FROM candidates as c WHERE c.candidate_id='$candidate_id'";
            $result_candidate = mysqli_query($connection, $query_candidate);
            if (mysqli_num_rows($result_candidate) > 0) {
                while ($value_query = mysqli_fetch_assoc($result_candidate)) {
                    $candidate_name = $value_query["candidate_name"];
                    $candidate_entourage = $value_query["candidate_entourage"];
                }
                $candidate_name = utf8_encode($candidate_name);
                $candidate_entourage = utf8_encode($candidate_entourage);
                //CRIA UM ARRAY COM OS DADOS DE TODOS OS CANDIDATOS
                $array = array(
                    'candidate_name' => $candidate_name,
                    'candidate_entourage' => $candidate_entourage,
                );
            }
            echo json_encode($array, JSON_UNESCAPED_UNICODE);
        }
    }
}

//FUNÇÃO QUE EDITA UM DETERMINADO CANDIDATO
function edit_candidate() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['candidate_id']) && isset($_POST['candidate_name']) && isset($_POST['candidate_entourage'])) {
            $candidate_id = $_POST['candidate_id'];
            $candidate_name = utf8_decode($_POST['candidate_name']);
            $candidate_entourage = utf8_decode($_POST['candidate_entourage']);
            //VERIFICA SE O CANDIDATO TEM NOME OU TEM PARTIDO OU TEM OS DOIS
            if ($candidate_entourage == '') {
                $query = "UPDATE candidates SET candidate_name='$candidate_name', candidate_entourage=null WHERE candidate_id='$candidate_id'";
            } else if ($candidate_name == '') {
                $query = "UPDATE candidates SET candidate_entourage='$candidate_entourage', candidate_name=null WHERE candidate_id='$candidate_id'";
            } else {
                $query = "UPDATE candidates SET candidate_name='$candidate_name', candidate_entourage='$candidate_entourage' WHERE candidate_id='$candidate_id'";
            }
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O CANDIDATO FOI EDITADO
                $updated = true;
                echo $updated;
            }
        }
    }
}

//FUNÇÃO QUE VAI BUSCAR UM DOCUMENTO ESPECIFICO E RETORNA PARA JQUERY EM FORMATO JSON
function get_specific_document() {
    include '../application/Db_connection.php';
    $doc_id = $_POST['doc_id'];
    $query_doc = "SELECT * FROM document_type as dc WHERE dc.doc_id='$doc_id'";
    $result_doc = mysqli_query($connection, $query_doc);
    if (mysqli_num_rows($result_doc) > 0) {
        while ($value_query = mysqli_fetch_assoc($result_doc)) {
            $doc_name = $value_query["doc_name"];
        }
        $doc_name = utf8_encode($doc_name);
    }
    echo json_encode($doc_name, JSON_UNESCAPED_UNICODE);
}

//FUNÇÃO QUE EDITA UM DOCUMENTO
function edit_doc() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $updated = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['doc_id']) && isset($_POST['doc_name'])) {
            $doc_id = $_POST['doc_id'];
            $doc_id = utf8_decode($doc_id);
            $doc_name = $_POST['doc_name'];
            $doc_name = utf8_decode($doc_name);
            $query = "UPDATE document_type SET doc_name='$doc_name' WHERE doc_id='$doc_id'";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O TIPO DE DOCUMENTO FOI EDITADO
                $updated = true;
                echo $updated;
            }
        }
    }
}

//FUNÇÃO QUE VAI BUSCAR OS CANDIDATOS DE UM EVENTO E RETORNA PARA JQUERY EM FORMATO JSON
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

//FUNÇÃO QUE VAI BUSCAR OS CANDIDATOS DE UM EVENTO - DE FORMA QUE O BOTÃO PARA VER OS CANDIDATOS DO EVENTO APENAS APAREÇA APENAS QUANDO EXISTEM CANDIDATOS ADICIONADOS AO EVENTO
function get_event_candidates($event_id) {
    include '../application/Db_connection.php';
    $query_event_candidate = "SELECT * FROM events_candidates as ec INNER JOIN candidates as c ON ec.candidate_id=c.candidate_id AND  ec.event_id = '$event_id'";
    $result_event_candidate = mysqli_query($connection, $query_event_candidate);
    return $result_event_candidate;
}

//FUNÇÃO QUE ELIMINA UM CANDIDATO DE UM EVENTO
function delete_event_candidate() {
    include '../application/Db_connection.php';
    //VERIFICA SE O SERVER VAI FAZER O MÉTODO POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $candidate_deleted = false;
        //VERIFICA SE EXISTE O POST DAS VARIÁVEIS VINDAS POR JQUERY
        if (isset($_POST['event_id']) && isset($_POST['candidate_id'])) {
            $candidate_id = $_POST['candidate_id'];
            $event_id = $_POST['event_id'];
            $query = "DELETE FROM events_candidates WHERE candidate_id = '$candidate_id' AND event_id= '$event_id'";
            if (mysqli_query($connection, $query)) {
                //VARIAVEL QUE RETORNA PARA O JQUERY QUE DIZ QUE O CANDIDATO DO EVENTO FOI ELIMINADO
                $candidate_deleted = true;
                echo $candidate_deleted;
            }
        }
    }
}

//FUNÇÃO QUE FAZ A EXPORTAÇÃO DOS VOTOS DE UM EVENTO
function export_votes_event() {
    include '../application/Db_connection.php';
    $output = '';
    $event_id = $_POST['event_id'];
    $query = "SELECT vote_key, c.candidate_name,c.candidate_entourage, v.candidate_id as 'v.candidate_id', c.candidate_id as 'c.candidate_id' FROM votes as v LEFT JOIN users as u ON u.user_id=v.user_id LEFT JOIN candidates as c ON v.candidate_id=c.candidate_id WHERE v.event_id='$event_id'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $output .= '
                        <table class="table" bordered="1">  
                        <tr>  
                        <th>Código de Voto</th>   
                        <th>Nome do Candidato</th>  
                        <th>Partido do Candidato</th>
                        </tr>';
        while ($row = mysqli_fetch_array($result)) {
            if ($row["v.candidate_id"] == 0) {
                $output .= '
                        <tr>  
                        <td>' . utf8_encode($row["vote_key"]) . '</td>  
                        <td>Voto em Branco</td>  
                        <td></td>  
                        </tr>';
            } else {
                $output .= '
                        <tr>  
                        <td>' . utf8_encode($row["vote_key"]) . '</td>  
                        <td>' . utf8_encode($row["candidate_name"]) . '</td>  
                        <td>' . utf8_encode($row["candidate_entourage"]) . '</td>  
                        </tr>';
            }
        }
        $output .= '</table>';
        echo $output;
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

//FUNÇÃO QUE VAI BUSCAR O NÚMERO TOTAL DE UTILIZADORES
function get_all_users() {
    include '../application/Db_connection.php';
    $query_all_users = "SELECT * FROM users WHERE user_role = 0";
    $result_all_users = mysqli_query($connection, $query_all_users);
    $all_users = mysqli_num_rows($result_all_users);
    return $all_users;
}

//FUNÇÃO QUE VAI BUSCAR O NÚMERO TOTAL DE EVENTOS ATIVOS
function get_all_events() {
    include '../application/Db_connection.php';
    $query_all_events = "SELECT * FROM events WHERE event_date_ini <= NOW() AND event_date_exp >= NOW()";
    $result_all_events = mysqli_query($connection, $query_all_events);
    $all_events = mysqli_num_rows($result_all_events);
    return $all_events;
}

//FUNÇÃO QUE VAI BUSCAR O NÚMERO TOTAL DE CANDIDATOS
function get_all_candidates() {
    include '../application/Db_connection.php';
    $query_all_candidates = "SELECT * FROM candidates";
    $result_all_candidates = mysqli_query($connection, $query_all_candidates);
    $all_candidates = mysqli_num_rows($result_all_candidates);
    return $all_candidates;
}

//FUNÇÃO QUE VAI BUSCAR O NÚMERO TOTAL DE DOCUMENTOS
function get_all_documents() {
    include '../application/Db_connection.php';
    $query_all_documents = "SELECT * FROM document_type";
    $result_all_documents = mysqli_query($connection, $query_all_documents);
    $all_documents = mysqli_num_rows($result_all_documents);
    return $all_documents;
}
