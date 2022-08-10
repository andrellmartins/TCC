<?php 
class estoque extends model{
    public function inclui($dados){
        $this->begin_transaction();
        

        $this->execQuery(
            "INSERT INTO produtos(fabricante, descricao, id_func_cadastro) VALUES 
            ('{$dados['fabricante']}','{$dados['descricao']}', {$dados['id_funcionario']})
            "
        );
        $insertProduto = $this->insert_id;

        if($dados['isMedicamento'] == 1){
            $this->execQuery(
                "INSERT INTO medicamentos (id_produto,laboratorio, nome_comercial, principio_ativo) VALUES 
                ($insertProduto,'{$dados['laboratorio']}', '{$dados['comercial']}', '{$dados['principio']}')
                "
            );
        }

        $this->commit();
        return true;
    }
    public function excluirProduto($id){
        
    }
}