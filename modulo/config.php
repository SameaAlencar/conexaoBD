<?php
/**************************************
 * Objetivo: arquivo responsável pela criação de variáveis e constantes di projeto
 *  obs(este arquivo fará a ponte entre a View e a model)
 * Autor: Samea
 * Data: 25/04/2022
 * Versão: 1.0
************************************/

// Limitação de 5mb para upload de imagem
const MAX_FILE_UPLOAD = 5120;
const EXT_FILE_UPLOAD = array("image/jpg", "image/jpeg", "image/gif", "image/png");
const DIRETORIO_FILE_UPLOAD = "arquivos/";

define('SRC', $_SERVER['DOCUMENT_ROOT'].'/conexaoBD/');


/***********************Funcoes Globais Para o projeto */

//function para converter um array num formato JSON
function createJSON($arrayDados)
{
    //validacao para tratar array sm dados
    if(!empty($arrayDados))
      {  //configura o padrao da conversao para o formato Json
        header('Content-Type: application/json');
        $dadosJson = json_encode($arrayDados);
    
        //converte array para json- json_encode();
        //converte json em array- json_decode();
        return $dadosJson;
      }else{
          return false;
      }
}




?>