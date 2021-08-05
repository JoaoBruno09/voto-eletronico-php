<?php

//VERIFICA SE ALGUEM ESTÁ A ACEDER A ESTE FICHEIRO PELO MÉTODO GET, CASO ESTEJA A FAZER REDIRECIONA PARA A PÁGINA DE UTILIZADOR
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('Location: https://voto-eletronico.jbr-projects.pt/');
}

//DETALHES DE SESSÃO PARA CONECTAR À BASE DE DADOS
$localhost = "localhost";
$username = "jbrproje";
$password = "j966VlpXr8";
$dbname = "jbrproje_ve";

//FAZ A CONEXÃO À BASE DE DADOS
$connection = mysqli_connect($localhost, $username, $password, $dbname);

//VERIFICA SE FEZ A CONEXÃO À BASE DE DADOS
if (!$connection) {
    die(mysqli_connect_error());
}


