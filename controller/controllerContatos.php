<?php
/**************************************
 * Objetivo: arquivo responsável pela manipulação de dados de contatos
 *  obs(este arquivo fará a ponte entre a View e a model)
 * Autor: Samea
 * Data: 04/03/2022
 * Versão: 1.0
************************************/
//função para receber dados da View e encaminhar para a model(inserir)
function inserirContato($dadosContato){

    // validação para verficar se o objeto está vazio
    if(!empty($dadosContato)){

        //Validação de caixa vazia dos elementos nome, celular e email, pois são obrigatórios no banco de dados
        if(!empty($dadosContato['txtNome']) && !empty($dadosContato['txtCelular']) && !empty($dadosContato['txtEmail'])){
           
            //Criação do array de dados que será encaminhado a model para inserir no BD,
            //é importante criar este array conforme as necessidades de manipulação do BD.
            //   OBS: Criar as chaves do array conforme os nomes dos atributos do BD.
            $arrayDados = array(
                "nome"      => $dadosContato['txtNome'], 
                "telefone"  => $dadosContato['txtTelefone'],
                "celular"   => $dadosContato['txtCelular'],
                "email"     => $dadosContato['txtEmail'],
                "obs"       => $dadosContato['txtObs']
            );

            //import do arquivo de modelagem para manipular o BD
            require_once('model/bd/contato.php');
            //Chama a função que fará o insert no BD(essa função está na model)
            if(insertContato($arrayDados))
                return true;
            else
                return array('idErro' =>1,
                            'message' => 'Não foi possível inserir os dados no BD');

        }else{
            return array('idErro' =>2,
                        'message' => 'Existem campos obrigatórios que não foram preenchidos');
        }
    } 

}

//função para receber dados da View e encaminhar para a model(atualizar)
function atualizarContato(){

}
//função para realizar a exclusão de um contato
function excluirContato($id){
    //validação para verificar se o id contém um número válido
    if($id != 0 && !empty($id) && is_numeric($id)){

        //import do arquivo de contato
        require_once('model/bd/contato.php');

        //chama a função da model e valida se o retorno foi verdadeiro ou falso
        if(deleteContato($id))
            return true;
        else
            return array('idErro'    => 3,
                        'message'    => 'O banco de dados não pode excluir o registro');
    }else{
        return array('idErro'    => 3,
        'message'    => 'Não é possível excluir um registro sem informar um id válido');
    }


}
//função para solicitar os dados da model e encaminhar a lista de contatos para a View
function listarContato(){

    //import do arquivo que vai buscar os dados no BD
    require_once('model/bd/contato.php');

    //chama a função que vai buscar os dados no BD
    $dados = selectAllContato();

    if(!empty($dados))
        return $dados;
    else
        return false;


}
//função para editar um contato através do id do registro
function editarContato($id){

    //validação para verificar se o id contém um número válido
    if($id != 0 && !empty($id) && is_numeric($id)){

        //import do arquivo de contato
        require_once('model/bd/contato.php');

        //chama a função na model e vai buscar no BD
        $dados = selectByIdContato($id);

        //valida se existem dados para serem devolvidos
        if(!empty ($dados)){
            return $dados;
        }else{
            return false;
        }

    }else{
        return array('idErro'    => 3,
        'message'    => 'Não é possível excluir um registro sem informar um id válido');
    
    }


}










?>