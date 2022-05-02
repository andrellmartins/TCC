<?php
    include 'funcoes.php';
    iniSystem();

    //load all base files
    loadBaseFiles();

    $requestFunction = getRequestFunction();
    if(function_exists($requestFunction))
        $requestFunction();
    else
        die('Função não conhecida pelo sistema.');
