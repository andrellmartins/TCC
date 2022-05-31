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
    

    public function execQuery($comandoExec){
        $query = model::$conn->query($comandoExec);
        if($query){
            return $query;
        }
        
        throw new mysqli_sql_exception(model::$conn->error,model::$conn->errno);
    }

    private function getInstance() 
    {
        if(!isset(model::$conn)){
            model::$conn = new mysqli('localhost','root','','clinica');
            model::$conn->set_charset('UTF8MB4');
        }
    }

    public function loadClassFromDatabase($className){
        $query = $this->execQuery("SELECT nome,extends FROM classes WHERE nome='$className'");
        $row = $query->fetch_assoc();
        $createClass = "class {$row['nome']}";
        if($row['extends'] != NULL){
            $createClass .=" extends {$row['extends']}";
        }
        eval("$createClass{}");
    }

}