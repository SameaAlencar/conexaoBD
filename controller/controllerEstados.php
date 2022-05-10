<?php
/**************************************
 * Objetivo: arquivo responsável pela manipulação de dados de contatos
 *  obs(este arquivo fará a ponte entre a View e a model)
 * Autor: Samea
 * Data: 10/05/2022
 * Versão: 1.0
************************************/

//import do arquivo de configuração do projeto
require_once('modulo/config.php');

//função para solicitar os dados da model e encaminhar a lista de contatos para a View
function listarEstado(){

    //import do arquivo que vai buscar os dados no BD
    require_once('model/bd/estado.php');

    //chama a função que vai buscar os dados no BD
    $dados = selectAllEstados();

    if(!empty($dados))
        return $dados;
    else
        return false;


}


?>