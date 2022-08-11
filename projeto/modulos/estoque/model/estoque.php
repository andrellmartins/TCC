<?php 
class estoque extends model{
    public function incluir($dados){
        $this->begin_transaction();
        

        $this->execQuery(
            "INSERT INTO produtos(descricao, fabricante, id_func_cadastro) VALUES 
            ('{$dados['descricao']}', '{$dados['fabricante']}', {$dados['id_funcionario']})
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


    public function excluir($id){
        $this->begin_transaction();
        
        $queryProduto = $this->execQuery("SELECT * FROM produtos p WHERE p.id=$id AND p.deletado=FALSE");
        if($queryProduto->num_rows == 0){
            throw new Exception('Produto não existe');
        }

        $this->execQuery("
            UPDATE produtos SET deletado=TRUE WHERE id=$id
        ");

        if($this->affected_rows != 1){
            throw new Exception('Erro ao deletar produto');
        }

        $this->commit();
        return true;
    }

    public function alterar($id){
        
    }

    
    
}