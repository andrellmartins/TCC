<?php
class gerenciador_estoque{
    public static function returnGrid($mostraBotaoInclui = true) {
        //carrega as produtos
        $model = new model;
        $query = $model->execQuery(
           'SELECT  p.id,p.descricao,p.fabricante,p.data_cadastro,
                    IF(m.id IS NULL,\'Não\',\'Sim\') isMedicamento,
                    pe.nome
            FROM produtos p
                LEFT JOIN medicamentos m
                    ON m.id_produto=p.id
                LEFT JOIN funcionario f
                    ON f.id=p.id_func_cadastro
                LEFT JOIN pessoas pe
                    ON pe.id=f.id_pessoa
            WHERE p.deletado=FALSE
            '
        );
        ob_start();
        if($mostraBotaoInclui){
            ?>
        <div class="container">
            <div class="row text-center">
                <div class="col w-auto">
                    <button class="btn btn-success" type="button" onclick="window.location='?modulo=estoque&programa=estoque&acao=formInclui'">Incluir</button>
                </div>
            </div>
        </div>
            <?php
        }
        ?>        
        <table class="table">
            <thead class="position-sticky top-0 bg-light">
                <tr>
                    <th>id </th>
                    <th>Descrição</th>
                    <th>Fabricante</th>
                    <th>Data Cadastro</th>
                    <th>É Medicamento ?</th>
                    <th>Nome Funcionario</th>
                    <th>Ações do Sistema</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = $query->fetch_assoc()){
                    ?>
                <tr>
                    <td><?php echo $row['id']            ?></td>
                    <td><?php echo $row['descricao']     ?></td>
                    <td><?php echo $row['fabricante']    ?></td>
                    <td><?php echo $row['data_cadastro'] ?></td>
                    <td><?php echo $row['isMedicamento'] ?></td>
                    <td><?php echo $row['nome']          ?></td>
                    <td>
                        <button class="btn ml-1 mr-1 mb-1 btn-warning" onclick="editarLinha  ( <?php echo $row['id'] ?> )" type="button">Editar     </button>
                        <button class="btn ml-1 mr-1 mb-1 btn-primary" onclick="verLinha     ( <?php echo $row['id'] ?> )" type="button">Visualizar </button>
                        <button class="btn ml-1 mr-1 mb-1 btn-danger"  onclick="excluirLinha ( <?php echo $row['id'] ?> )" type="button">Excluir    </button>
                    </td>
                </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
        <script>
            function editarLinha(idLinha){
                window.location.href = `?modulo=estoque&programa=estoque&acao=formAlterarProduto&id=${idLinha}`;
            }
            function verLinha(idLinha){
                window.location.href = `?modulo=estoque&programa=estoque&acao=formVisualizaProduto&id=${idLinha}`;
            }
            function excluirLinha(idLinha){
                swal({
                    'title': 'Tem certeza que deseja deletar o produto ?',
                    'icon' : 'warning',
                    'buttons':{
                        confirm:{
                            text: "Sim",
                            value: true,
                            closeModal: true,
                        },
                        cancel:{
                            text: "Não",
                            value: false,
                            visible:true,
                            closeModal: true,
                        },
                    }
                })
                .then(opcao => {
                    if(!opcao) return;

                    window.location.href = `?modulo=estoque&programa=estoque&acao=excluirProduto&id=${idLinha}`;
                })
            }
        </script>
        <?php
        return ob_get_clean();
    }
    public static function returnCadastroProduto($return=false, $tipo = '', $acaoForm = '', $idProduto=false){
        $model = new model;
        ob_start();
        ?>
        <form action="<?php echo $acaoForm ?>" method="post">
            <div class="container w-50 self-align-middle">
                <div class="row text-center">
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="descricao" id="floatingDescricao" placeholder="Descricao" required>
                        <label for="floatingDescricao">Descrição</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="fabricante" id="floatingFabricante" placeholder="Fabricante" required>
                        <label for="floatingFabricante">Fabricante</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingMedicamento" name="isMedicamento" required>
                            <option value="" selected>Produto é Medicamento ?</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                        <label for="floatingTipo">É medicamento ?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="laboratorio" id="floatingLaboratorio" placeholder="Laboratorio" required>
                        <label for="floatingLaboratorio">Laboratório</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="principio" id="floatingPrincipio" placeholder="Principio" required>
                        <label for="floatingPrincipio">Princípio Ativo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="comercial" id="floatingComercial" placeholder="Comercial" required>
                        <label for="floatingComercial">Nome Comercial</label>
                    </div>
                    <div class="form-floating mb-3">
                        <table class="table" id="tabelaItensLote">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Validade</th>
                                    <th>Quantidade</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-floating mb-3">
                        <button class="btn btn-primary" type="button" onclick="novaLinhaLote()">Novo Lote</button>
                    </div>
                    <div class="form-floating mb-3">
                            <?php
                            echo [
                                'alterar' => 
                                    "<button type=\"submit\" class=\"btn btn-primary\">Salvar</button>
                                    <button type=\"button\" onclick=\"history.back()\" class=\"btn btn-info\">Voltar</button>",
                                'visualizar' => 
                                    "<button type=\"button\" onclick=\"history.back()\" class=\"btn btn-info\">Voltar</button>",
                                'inclui' => 
                                    "<button type=\"submit\" class=\"btn btn-primary\">Cadastrar</button>
                                     <button type=\"button\" onclick=\"history.back()\" class=\"btn btn-info\">Voltar</button>",
                            ][$tipo] ?? '';
                            ?>
                    </div>
                </div>
            </div>
        </form>
        <script>

            

            $(()=>{
                $("#floatingMedicamento").on('change',(evento)=>{
                    let valorMedicamento = evento.currentTarget.value,
                        disable = $("#floatingLaboratorio,#floatingPrincipio,#floatingComercial"),
                        enable  = $("")
                    
                    if(valorMedicamento == 1){
                        enable = disable;
                        disable = $("")
                    }
                    mostrarCamposForm(enable)
                    esconderCamposForm(disable)
                }).trigger('change')

                
            })

                            

            function novaLinhaLote(){
                let idLinha = $("#tabelaItensLote > tbody > tr").length + 1;
                $("#tabelaItensLote > tbody").append(`
                <tr class="linhaLote">
                    <td>
                        <div class="form-floating mb-3">
                            <input type="Input" class="form-control" name="lote[${idLinha}]" id="floatingLote${idLinha}" placeholder="Lote" required>
                            <label for="floatingLote${idLinha}">Lote</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-floating mb-3">
                            <input type="Date" class="form-control" name="validade[${idLinha}]" id="floatingValidade${idLinha}" placeholder="Validade" required>
                            <label for="floatingValidade${idLinha}">Data de Validade</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-floating mb-3">
                            <input type="number" min="1" class="form-control" name="qtd[${idLinha}]" id="floatingQtd${idLinha}" placeholder="Quantidade" required>
                            <label for="floatingQtd${idLinha}">Quantidade</label>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="$(this).closest('.linhaLote').remove()">X</button>
                    </td>
                </tr>
                
                `)
            }

            <?php
                if($idProduto){
                    $query = $model->execQuery(
                        "SELECT
                            p.descricao, p.fabricante, 
                            IF(ISNULL(m.id),0,1) isMedicamento,
                            m.laboratorio,
                            m.principio_ativo,
                            m.nome_comercial
                        FROM produtos p
                            LEFT JOIN medicamentos m
                                ON m.id_produto=p.id
                        WHERE p.id=$idProduto                        "
                    );

                    $dadosProduto = $query->fetch_assoc();
                    echo "
                        $(\"#floatingDescricao\"        ).val('{$dadosProduto['descricao']}');
                        $(\"#floatingFabricante\"       ).val('{$dadosProduto['fabricante']}');
                        $(\"#floatingMedicamento\"      ).val('{$dadosProduto['isMedicamento']}').trigger('change');
                        $(\"#floatingLaboratorio\"      ).val('{$dadosProduto['laboratorio']}');
                        $(\"#floatingPrincipio\"        ).val('{$dadosProduto['principio_ativo']}');
                        $(\"#floatingComercial\"        ).val('{$dadosProduto['nome_comercial']}');
                        ";
                }

                if($tipo == 'visualizar'){
                    echo 
                    "
                    $(\"#floatingDescricao, #floatingFabricante, #floatingMedicamento, #floatingLaboratorio, #floatingPrincipio, #floatingComercial\").prop('disabled',true)
                    ";
                }

                ?>

        
        </script>
        <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
    }
}