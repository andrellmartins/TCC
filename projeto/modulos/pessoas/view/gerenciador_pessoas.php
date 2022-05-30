<?php
class gerenciador_pessoas{
    public static function returnGrid() {
        //carrega as pessoas
        $model = new model;
        $query = $model->query(
           'SELECT  p.id, p.nome,  p.ender, p.telefone, p.cpf,
                    f.id id_funcionario, f.pis,
                    c.*
            FROM pessoas p 
                LEFT JOIN funcionario f 
                    ON f.id_pessoa=p.id 
                LEFT JOIN cargos c
                    ON f.id_cargo=c.id
                LEFT JOIN pacientes pa 
                    ON pa.id_pessoa=p.id '
        );
        var_dump($model->);exit;
        echo "<pre>";
        while($row = $query->fetch_assoc()){
            print_r($row);
        }
        //montar tabela
        //mostrar pessoas

        ob_start();
        ?>
        OI SOU O GRID :3 
        <?php
        return ob_get_clean();
    }
}