<?php

function incluirpessoa(){
    include($_SERVER['DOCUMENT_ROOT'].'/conexao.php');
    $nome = filter_input(INPUT_POST,'nome');
    $endereço = filter_input(INPUT_POST,'endereço');
    $telefone = filter_input(INPUT_POST,'telefone');
    $cpf = filter_input(INPUT_POST,'cpf');
    $pis = filter_input(INPUT_POST,'pis');
    $tipo = filter_input(INPUT_POST,'tipo');
    $usuario = filter_input(INPUT_POST,'usuario');
    $senha = filter_input(INPUT_POST,'senha');
    
    $con->begin_transaction();
    include_once($_SERVER['DOCUMENT_ROOT'].'/modulos/pessoas/model/pessoas.php');
    $idPessoa = (new pessoas())->incluir($nome,$endereço,$telefone,$cpf,$pis,$tipo);

    if($idPessoa === false){
        $con->rollback();
        die('Não foi possível incluir pessoa');
    }
    
    include_once($_SERVER['DOCUMENT_ROOT'].'/modulos/pessoas/model/usuario.php');
    $idUsuario = (new usuario())->incluir($idPessoa,$usuario,$senha);
    
    if($idUsuario === false){
        $con->rollback();
        die('Não foi possível incluir usuário');
    }
    $con->commit();
    
    ?>
    <script>alert('Usuário Cadastrado com Sucesso');document.location.href='/';</script>
    <?php
}

function login(){
    $usuario = filter_input(INPUT_POST,'username');
    $senha = filter_input(INPUT_POST,'password');

    include_once($_SERVER['DOCUMENT_ROOT'].'/modulos/pessoas/model/usuario.php');
    $idPessoa = (new usuario())->auth($usuario,$senha);

    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'].'/modulos/pessoas/model/pessoas.php');
    $dadosPessoa = (new pessoas)->getPessoa($idPessoa);
    if(!is_null($dadosPessoa))
        $_SESSION['pessoa'] = $dadosPessoa;
    
    header('Location: /inicio.php');
}

function auth(){
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['pessoa'])){
        ?>
        
        <script>alert('Usuário sem Autenticação');document.location.href='/';</script>
        <?php
    }
}

$acao = filter_input(INPUT_GET,'acao');

if(function_exists($acao)){
    $acao();
}



