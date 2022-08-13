<?php
    include 'funcoes.php';
    iniSystem();

    //load all base files
    loadBaseFiles();

    $requestFunction = getRequestFunction();
    if(function_exists($requestFunction)){
        try {
            $requestFunction();
        }catch(Throwable $t){
            throw new error($t->getMessage(),$t->getCode(),$t);
        }
    }else{
        die('Função não conhecida pelo sistema.');
    }
