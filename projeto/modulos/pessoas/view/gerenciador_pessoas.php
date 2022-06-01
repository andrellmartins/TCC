<?php
class gerenciador_pessoas{
    public static function returnGrid($mostraBotaoInclui = true) {
        //carrega as pessoas
        $model = new model;
        $query = $model->execQuery(
           'SELECT  p.id, p.nome,  p.ender, p.telefone, p.cpf
            FROM pessoas p 
            WHERE p.deletado=FALSE
            '
        );
        ob_start();
        if($mostraBotaoInclui){
            ?>
        <div class="row text-center">
            <div class="col w-auto">
                <button class="btn btn-success" type="button" onclick="window.location='?modulo=pessoas&programa=pessoas&acao=formInclui'">Incluir</button>
            </div>
        </div>
            <?php
        }
        ?>        
        <table class="table">
            <thead class="position-sticky top-0 bg-light">
                <tr>
                    <th>id </th>
                    <th>Nome  </th>
                    <th>Endereço </th>
                    <th>Telefone </th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while($row = $query->fetch_assoc()){
                    ?>
                <tr>
                    <td><?php echo $row['id']              ?></td>
                    <td><?php echo $row['nome']            ?></td>
                    <td><?php echo $row['ender']           ?></td>
                    <td><?php echo $row['telefone']        ?></td>
                    <td><?php echo $row['cpf']             ?></td>
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
                window.location.href = `?p=modulo=pessoas&programa=pessoas&acao=formAlterarPessoa&id=${idLinha}`;
            }
            function verLinha(idLinha){
                window.location.href = `?p=modulo=pessoas&programa=pessoas&acao=formVisualizaPessoa&id=${idLinha}`;
            }
            function excluirLinha(idLinha){
                swal({
                    'title': 'Tem certeza que deseja deletar o cadastro ?',
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

                    window.location.href = `?p=modulo=pessoas&programa=pessoas&acao=excluirPessoa&id=${idLinha}`;
                })
            }
        </script>
        <?php
        return ob_get_clean();
    }

    public static function returnCadastroPessoa($return = false, $tipo = 'login', $acaoForm = '', $idPessoa=false){
        $model = new model;

        $query = $model->execQuery(
            'SELECT u.uf,p.pais,u.id 
            FROM uf u 
                INNER JOIN pais p 
                    ON u.id_pais=p.id
            ORDER BY p.pais,u.uf'
        );
        $htmlUF = '';
        while($option = $query->fetch_assoc()){
            $htmlUF .= "<option value=\"{$option['id']}\">{$option['pais']} - {$option['uf']}</option>";
        }
        
        $query = $model->execQuery('SELECT id,cargo FROM cargos');
        $htmlCargo = '';
        while($option = $query->fetch_assoc()){
            $option['cargo'] = ucfirst(strtolower($option['cargo']));
            $htmlCargo .= "<option value=\"{$option['id']}\">{$option['cargo']}</option>";
        }

        $query = $model->execQuery('SELECT id,nome FROM convenios');
        $htmlConvenio = '';
        while($option = $query->fetch_assoc()){
            $option['nome'] = ucfirst(strtolower($option['nome']));
            $htmlConvenio .= "<option value=\"{$option['id']}\">{$option['nome']}</option>";
        }

        if($tipo == 'login'){
            $acaoForm = '?modulo=pessoas&programa=pessoas&acao=cadastro';
        }

        ob_start();
        ?>
        <form action="<?php echo $acaoForm ?>" method="post">
            <div class="container w-50 self-align-middle">
                <div class="row text-center">
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="nome" id="floatingNome" placeholder="Nome" required>
                        <label for="floatingNome">Nome</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="endereco" id="floatingEndereço" placeholder="Endereço" required>
                        <label for="floatingEndereço">Endereço</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="telefone" id="floatingTelefone" placeholder="Telefone" required>
                        <label for="floatingTelefone">Telefone</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSexo" name="sexo" required>
                            <option value="" selected>Selecionar Sexo</option>
                            <option value="F">Mulher</option>
                            <option value="M">Homem</option>
                        </select>
                        <label for="floatingSexo">Sexo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="nascimento" id="floatingNascimento" placeholder="Nascimento" required>
                        <label for="floatingNascimento">Nascimento</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="cpf" id="floatingCpf" placeholder="Cpf" required>
                        <label for="floatingCpf">Cpf</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingTipo" name="tipo" required>
                            <option value="" selected>Selecionar Tipo de Usuário</option>
                            <option value="0">Paciente</option>
                            <option value="1">Funcionário</option>
                        </select>
                        <label for="floatingTipo">Tipo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="pis" id="floatingPis" placeholder="Pis" required>
                        <label for="floatingPis">Pis</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingCargo" name="cargo" required>
                            <option selected>Selecionar Cargo do Funcionário</option>
                            <?php echo $htmlCargo ?>
                        </select>
                        <label for="floatingCargo">Cargo</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="crm" id="floatingCrm" placeholder="CRM" required>
                        <label for="floatingCrm">CRM</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="crf" id="floatingCrf" placeholder="CRF" required>
                        <label for="floatingCrf">CRF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingUf" name="uf" required>
                            <option selected>Selecionar UF do Documento</option>
                            <?php echo $htmlUF ?>
                        </select>
                        <label for="floatingUf">UF</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingConvenio" name="convenio" required>
                            <option selected>Selecionar Convênio</option>
                            <?php echo $htmlConvenio ?>
                        </select>
                        <label for="floatingConvenio">Convenio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Input" class="form-control" name="usuario" id="floatingUsuario" placeholder="Usuario" required>
                        <label for="floatingUsuario">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="Password" class="form-control" name="senha" id="floatingSenha" placeholder="Senha" required>
                        <label for="floatingSenha">Senha</label>
                    </div>
                    <?php if ($tipo == 'login'){ ?>
                    <div class="form-floating mb-3">
                        <p>Já tem Usuário ? <a href="/">Faça Login</a></p>
                    </div>
                    <?php } ?>
                    <div class="form-floating mb-3">
                        
                            <?php
                            echo [
                                'login' =>  
                                    "<button type=\"submit\" class=\"btn btn-primary\">Cadastrar</button>",
                                'alterar' => 
                                    "<button type=\"submit\" class=\"btn btn-primary\">Salvar</button>
                                    <button type=\"button\" onclick=\"history.back()\" class=\"btn btn-info\">Voltar</button>",
                                'visualizar' => 
                                    "<button type=\"button\" onclick=\"history.back()\" class=\"btn btn-info\">Voltar</button>",
                                'inclui' => 
                                    "<button type=\"submit\" class=\"btn btn-primary\">Cadastrar</button>
                                     <button type=\"button\" onclick=\"window.location.href='?modulo=pessoas&programa=pessoas&acao=inicio'\" class=\"btn btn-info\">Voltar</button>",
                            ][$tipo] ?? '';
                            ?>
                    </div>
                </div>
            </div>
        </form>
        <script>
            $(()=>{
                //carrega as mascaras dos campos
                    $('#floatingCpf').mask('000.000.000-00',{
                        onComplete:function(){
                            let cpfField = $('#floatingCpf'),
                                cpfValue = cpfField.cleanVal();
                            if(!validaCPF(cpfValue)){
                                swal('Erro no Preenchimento do Formulário','CPF inválido!','warning')
                                .then(()=>{
                                    cpfField.val(
                                        cpfField.masked(
                                            cpfValue.substring(0,cpfValue.length-1)
                                        )
                                    ).trigger('focus');
                                });
                            }
                        }
                    });; //14
                    $('#floatingTelefone').mask('+00 (00) 0 0000-0000')
                    //20
                    $('#floatingPis').mask('000.00000.00-0');//14
                    $('#floatingCrm, #floatingCrf').mask('00000');//5
                //esconde CRF CRM e UF
                    let disabled = $("#floatingCrf,#floatingUf,#floatingCrm,#floatingCargo,#floatingConvenio");
                    disabled.prop('disabled',true);
                    disabled.parent().css('display','none');
                //onchange floatingTipo
                $('#floatingTipo').on('change',(evento)=>{
                    let tipo = $(evento.currentTarget),
                        tipoValue = tipo.val();
                    if(tipoValue == ''){
                        enable = $("");
                        disable = $("#floatingPis,#floatingCrf, #floatingUf, #floatingCrm, #floatingCargo, #floatingConvenio")
                    } else if (tipoValue == "0"){
                        enable = $('#floatingConvenio'),
                        disable = $('#floatingPis,#floatingCrf, #floatingUf, #floatingCrm, #floatingCargo');
                    } else if (tipoValue == "1"){
                        enable  = $('#floatingPis,#floatingCargo');
                        disable = $('#floatingConvenio');
                    }

                    mostrarCamposForm(enable);
                    esconderCamposForm(disable);
                   
                }).trigger('change');
                $("#floatingCargo").on("change",function(evento){
                    let cargoValue = evento.currentTarget.value;
                    //funcionário
                    switch(cargoValue){
                        //médico
                        case '2':
                            enable      = $("#floatingCrm,#floatingUf");
                            disable    = $("#floatingCrf,#floatingConvenio");
                            break;
                        //farmacêutico
                        case '3':
                            enable      = $("#floatingCrf,#floatingUf");
                            disable    = $("#floatingCrm,#floatingConvenio");
                            break;
                        //outro funcionário
                        case '4':
                            enable      = $("")
                            disable     = $('#floatingCrf, #floatingUf, #floatingCrm,#floatingConvenio');
                        break;
                    }
                    mostrarCamposForm(enable);
                    esconderCamposForm(disable);
                }).trigger("change")

                <?php
                if($idPessoa){
                    $query = $model->execQuery(
                        "SELECT
                            p.nome, p.ender, p.telefone, p.cpf,p.data_nasc,p.sexo,
                            IF(ISNULL(f.id),0,1) tipo,
                            f.pis,
                            f.id_cargo,
                            m.crm,
                            fa.crf,
                            COALESCE(m.id_uf_crm,fa.id_uf_crf,'') uf,
                            pa.id_convenio convenio,
                            u.usuario, u.senha
                        FROM pessoas p
                            LEFT JOIN usuarios u
                                ON u.id_pessoa=p.id
                            LEFT JOIN funcionario f
                                ON f.id_pessoa=p.id
                            LEFT JOIN medico m
                                ON m.id_funcionario=f.id
                            LEFT JOIN farmaceutico fa
                                ON fa.id_funcionario=f.id
                            LEFT JOIN pacientes pa
                                ON pa.id_pessoa=p.id
                        WHERE p.id=$idPessoa
                        "
                    );

                    $dadosPessoa = $query->fetch_assoc();
                    echo "
                        $(\"#floatingNome\"        ).val('{$dadosPessoa['nome']}');
                        $(\"#floatingEndereço\"    ).val('{$dadosPessoa['ender']}');
                        $(\"#floatingTelefone\"    ).val('{$dadosPessoa['telefone']}');
                        $(\"#floatingCpf\"         ).val('{$dadosPessoa['cpf']}');
                        $(\"#floatingTipo\"        ).val('{$dadosPessoa['tipo']}').trigger('change');
                        $(\"#floatingPis\"         ).val('{$dadosPessoa['pis']}');
                        $(\"#floatingCargo\"       ).val('{$dadosPessoa['id_cargo']}').trigger('change');
                        $(\"#floatingCrm\"         ).val('{$dadosPessoa['crm']}');
                        $(\"#floatingCrf\"         ).val('{$dadosPessoa['crf']}');
                        $(\"#floatingUf\"          ).val('{$dadosPessoa['uf']}');
                        $(\"#floatingConvenio\"    ).val('{$dadosPessoa['convenio']}');
                        $(\"#floatingUsuario\"     ).val('{$dadosPessoa['usuario']}');
                        $(\"#floatingSexo\"        ).val('{$dadosPessoa['sexo']}');
                        $(\"#floatingNascimento\"  ).val('{$dadosPessoa['data_nasc']}');
                        ";
                }

                if($tipo == 'visualizar'){
                    echo 
                    "
                    $(\"#floatingNome, #floatingEndereço, #floatingTelefone, #floatingCpf, #floatingTipo, #floatingPis, #floatingCargo, #floatingCrm, #floatingCrf, #floatingUf, #floatingConvenio, #floatingUsuario, #floatingSenha, #floatingSexo, #floatingNascimento\").prop('disabled',true)
                    ";
                }

                if($tipo != 'login' && $tipo != 'inclui'){
                    echo "
                    $(\"#floatingTipo, #floatingCargo\").prop('disabled',true)
                    ";
                }
                ?>

            })
        </script>
        <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
    }

    public static function returnLogin($return = false){
        ob_start();
        ?>
        <div class="container w-100 h-100 d-flex align-items-center justify-content-center">
            <div class="row text-center">
                <form action="?modulo=pessoas&programa=pessoas&acao=login" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" name="username" id="username" placeholder="usuário" required>
                        <label for="username">Usuário</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                        <label for="password">Senha</label>
                    </div>
                    <div class="form-floating mb-3">
                        <p>Não tem Usuário ? <a href="?modulo=pessoas&programa=pessoas&acao=formCadastro">Cadastre-se</a></p>
                        <p><a href="#">Equeceu a Senha ? </a></p>
                    </div>
                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-primary">Fazer Login</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
    }

}