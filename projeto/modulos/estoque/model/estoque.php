<?php 
class estoque extends model{
    public function inclui($dados){
        $this->begin_transaction();
        
        
        
        $this->execQuery(
            "INSERT INTO produtos(descricao, id_func_cadastro) VALUES 
            ('{$dados['descricao']}, {$_SESSION['usuarioLogado']}')"
        );
        if($dados['isMedicamento'] == 1){
            $this->execQuery(
                "INSERT INTO medicamentos (laboratorio, nome_comercial, principio_ativo) VALUES 
                ('{$dados['laboratorio']}, {$dados['comercial']}, {$dados['principio']}')
                "
            );
        }


        $this->commit();
        return true;
    }
}