<?php
class model{
    private static $conn;
    
    public function __call($name,$arguments){
        return model::$conn->$name(...$arguments);
    }
    
    public function __get($property)
    {
        return model::$conn->$property;
    }

    public function __construct(){
        $this->getInstance();
    }

    public function inserted_id(){
        return model::$conn->inserted_id;
    }
    
    private function getInstance() 
    {
        if(!isset(model::$conn)){
            model::$conn = new mysqli('localhost','root','','clinica');
            model::$conn->set_charset('UTF8MB4');
        }
    }

    public function loadClassFromDatabase($className){
        $query = $this->query("SELECT nome,extends FROM classes WHERE nome='$className'");
        if($query->num_rows == 1){
            $row = $query->fetch_assoc();
            $createClass = "class {$row['nome']}";
            if($row['extends'] != NULL){
                $createClass .=" extends {$row['extends']}";
            }
            eval("$createClass{}");
        }
    }
    public function crud($dados,$acaoCRUD){
        $this->logcrud($dados,$acaoCRUD);
        if(method_exists($this,$acaoCRUD)){
            $this->$acaoCRUD($dados);
        }
    }
    // formulario{
    //     tipoDeCampo[
    //         caracter TAMANHO MASCARA
    //         int TAMANHO INT, TAMANHO DECIMAL
    //         selecao de dados(Pequeno) {chave:valor,chave:valor,...}
    //         ligacaoTabela(Grande) / {[chave:chave,campo1,campo2,campo3,...],...}
    //         data RETROATIVO ? FUTURO ? type date
    //         radio[selecao de dados Pequena] [chave:valor,chave:valor,...]
    //         checkbox(on/off) titulo
    //     ]
    // }
    // public function inclui($dados){
    //     $sql = 
    //         'SELECT tc.* 
    //         FROM tabelas_coluna tc 
    //             INNER JOIN tabelas t 
    //                 ON t.id=tc.id_tabela
    //                 AND t.nomeTabela=\''.get_class($this).'\'';
    //     $query = $this->query($sql);
    //     while($campo = $query->fetch_assoc()){
    //         $valorCampo = $dados[$campo['nome']];
    //         if($campo['obrigatorio']){
    //         }
    //     }
    // }

    // public function validarCampoEntrada($campo,$valor){
        
    // }

}