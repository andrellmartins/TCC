<?php

function iniSystem(){
    spl_autoload_register(
        function($className){
            if(loadClassFromFile($className)){}
            elseif((new model)->loadClassFromDatabase($className)){}
            return class_exists($className);
        }
    );
    $catchFunction = 
    function($error_number, $error_message, $error_filename = 'no filename supplied', $error_line = 'no line supplied', $error_context = 'no context supplied'){
        $error = new error_component($error_number, $error_message, $error_filename, $error_line, $error_context);
        $error->showFullMessage();
    };

    set_error_handler($catchFunction,E_ALL);
    set_exception_handler(
        function($exception){
            $exception = new error_component($exception->getCode(), $exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception);
            $exception->showFullMessage();
        }
    );
}

function loadClassFromFile($className){
    $className = strtolower($className);
    $modulo = filter_input(INPUT_GET,'modulo') ?? 'pessoas';
    $inicio = $modulo == 'base' ? '' : 'modulos'.DIRECTORY_SEPARATOR;
    
    $iniPath = syspath($inicio . $modulo . DIRECTORY_SEPARATOR);
    $dirDiretorioBase = dir($iniPath);
    
    while($diretorioMVC = $dirDiretorioBase->read()){
        if(in_array($diretorioMVC,['.','..'])){
            continue;
        }
        $arquivoClassePath = "{$iniPath}{$diretorioMVC}". DIRECTORY_SEPARATOR ."$className.php";
        if(!file_exists($arquivoClassePath)){
            continue;
        }
        include_once $arquivoClassePath;
        return true;
    }
    return false;
}

function loadBaseFiles(){
    $dirDiretorioBase = dir('base');
    while($diretorioMVCName = $dirDiretorioBase->read() ){
        if(in_array($diretorioMVCName,['.','..','view'])){
            continue;
        }
        $dirDiretorioMVC = dir('base'.DIRECTORY_SEPARATOR.$diretorioMVCName);
        while($arquivoBase = $dirDiretorioMVC->read() ){
            if(in_array($arquivoBase,['.','..'])){
                continue;
            }
            $caminhoArquivo = syspath('base' .DIRECTORY_SEPARATOR . $diretorioMVCName .DIRECTORY_SEPARATOR . $arquivoBase);
            if(file_exists($caminhoArquivo))
                include_once $caminhoArquivo;
        }
    }
}
function recursiveLoadFilesFromDirectory($directoryPath){
    $dirDirectory = dir($directoryPath);
    while($dirItem = $dirDirectory->read()){
        
    }
}

function tratarRequisicaoReqview(){
    $path = filter_input(INPUT_GET,'path');
    
    $path = syspath('base' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $path);
    if(file_exists($path)){
        echo file_get_contents($path);
    }else{
        die('programa não existe');
    }

}
function tratarRequisicaoNormal(){
    $modulo = filter_input(INPUT_GET,'modulo') ?? 'pessoas';
    $inicio = $modulo == 'base' ? '' : 'modulos'.DIRECTORY_SEPARATOR;
    $programa = (filter_input(INPUT_GET,'programa') ?? 'pessoas');
    $controller = $programa . 'controller';
    $acao = filter_input(INPUT_GET,'acao') ?? 'main';
    
    $path = syspath($inicio . $modulo . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . "{$controller}.php");
    if(file_exists($path)){
        include_once $path;
    }else{
        die('programa não existe');
    }

    if(!class_exists($controller)){
        die('classe não existe');
    }
    $classe = new $controller($modulo);

    if(!method_exists($classe,$acao)){
        die('ação não existe');
    }
    $classe->$acao();
}

function syspath($finalpath){
    return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $finalpath;
}

function reqpath($finalPath){
    return $_SERVER['HTTP_HOST'] . DIRECTORY_SEPARATOR . $finalPath;
}

function getRequestFunction(){
    $requestType = ucfirst(strtolower(filter_input(INPUT_GET,'requestType') ?? 'normal'));
    return 'tratarRequisicao' . $requestType;
}