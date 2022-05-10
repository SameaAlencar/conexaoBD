<?php
    //import do arquivo de configurações do projeto
    require_once('modulo/config.php');

    $form = (string) "router.php?componente=contatos&action=inserir";
    //variável para carregar o nome da foto do banco de dados
    $foto = (string) null;
    $idestado = (string) null;

      
    //valida se a utilização de variavel de sessao esta ativa no servidor 
    if(session_status()){

        //valida se a variavel de sessão dadosContato não está vazia
        if(!empty($_SESSION['dadosContato'])){

            $id       = $_SESSION['dadosContato']['id'];
            $nome     = $_SESSION['dadosContato']['nome'];
            $telefone = $_SESSION['dadosContato']['telefone'];
            $celular  = $_SESSION['dadosContato']['celular'];
            $email    = $_SESSION['dadosContato']['email'];
            $obs      = $_SESSION['dadosContato']['obs'];
            $foto     = $_SESSION['dadosContato']['foto'];
            $idestado = $_SESSION['dadosContato']['idestado'];

            $form = "router.php?componente=contatos&action=atualizar&id=".$id."&foto=".$foto;
            unset($_SESSION['dadosContato']);
           
         }
 }
    

?>

<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">


    </head>
    <body>
       
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
                
            </div>
            <div id="cadastroInformacoes">
                <!-- enctype = "multipart/form-data
                    Essa opção obrigatória para enviar arquivos do formulário em html para o servidor -->
                <form  action="<?=$form?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Nome: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=isset($nome)?$nome:null?>" placeholder="Digite seu Nome" maxlength="100">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Estado: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstado" id="">
                                <option value="">Selecione um item</option>
                                <?php
                                    require_once('controller/controllerEstados.php');
                                    $listarEstados = listarEstado();

                                    if($listarEstados){
                                        foreach ($listarEstados as $item){

                                        ?>
                                        <option <?=$idestado==$item['idestado']?'selected':null?> value ="<?=$item['idestado']?>" ><?=$item['nome']?></option>

                                        <?php
                                    }
                                }
                                
                                ?>

                            </select>
                        </div>
                    </div>
                                     
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Telefone: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtTelefone" value="<?=isset($telefone)?$telefone:null?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Celular: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="tel" name="txtCelular" value="<?=isset($celular)?$celular:null?>">
                        </div>
                    </div>
                   
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Email: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=isset($email)?$email:null?>">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Escolha um arquivo: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="file" name="fleFoto" accept=".jpg, .png, .jpeg, .gif">
                        </div>
                    </div>

                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <label> Observações: </label>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7"><?=isset($obs)?$obs:null?></textarea>
                        </div>
                    </div>

                    <div class="campos">
                        <img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>" alt="">

                    </div>
                   
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas destaque"> Nome </td>
                    <td class="tblColunas destaque"> Celular </td>
                    <td class="tblColunas destaque"> Email </td>
                    <td class="tblColunas destaque"> Foto </td>
                    <td class="tblColunas destaque"> Opções </td>
                </tr>
                
               <?php
               //import do arquivo da controller para solicitar a listagem dos dados
                require_once('controller/controllerContatos.php');

                //chama a função que vai retornar os dados do contato
                $listContato = listarContato();

                //estrutura de repetição para retirar os dados do array e printar na tela

                if($listContato){
                    foreach($listContato as $item){

                    //variavel para carregar a foto que veio do Banco de dados
                    $foto = $item['foto'];

               
               ?>
                <tr id="tblLinhas">
                    <td class="tblColunas registros"><?=$item['nome']?></td>
                    <td class="tblColunas registros"><?=$item['celular']?></td>
                    <td class="tblColunas registros"><?=$item['email']?></td>
                    <td class="tblColunas registros"><img src="<?=DIRETORIO_FILE_UPLOAD.$foto?>" class="foto" alt=""></td>
                   
                    <td class="tblColunas registros">
                            <a href="router.php?componente=contatos&action=editar&id=<?=$item['id']?>">
                            <img src="img/edit.png" alt="Editar" title="Editar" class="editar">
                            </a>

                            <a onclick="return confirm('Tem certeza que quer excluir?');"
                                         href="router.php?componente=contatos&action=deletar&id=<?=$item['id']?>&foto=<?=$foto?>">
                                <img src="img/trash.png" alt="Excluir" title="Excluir" class="excluir">
                            </a>
                            <img src="img/search.png" alt="Visualizar" title="Visualizar" class="pesquisar">
                    </td>
                </tr>
                <?php

                    }
                }
                ?>
            </table>
        </div>
    </body>
</html>