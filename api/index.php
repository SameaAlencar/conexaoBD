<?php
    /*****
    *Objetivo: arquivo principal da api que irá receber a url requisitada e redirecionar para as API's(router)
    *Data:19/05/2022
    *Autor: Samea Alencar
    *Versão: 1.0
     *****/

//Permire ativar quais endereços de sites que poderão fazer requisições na api(*= LIBERA PARA TODOS)
    header('Access-Control-Allow-Origin: *');
//Permite ativar os métodos do protocolo HTTP que irão requisitar a api
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//Permite ativar o Content-Type das requisições(Formato de dados que será utilizado ex: JSON, XML, FORM/DATA, etc)
    header('Access-Control-Allow-Header: Content-Type');
//Permite liberar quais Content-Type serão utilizados na API
    header('Content-Type: application/json');

  //Recebe a url digitada na requisição 
    $urlHTTP = (string) $_GET['url'];
    
    //converte a url requisitada em um array para dividir as opções de busca, que é separada pela "/"
    $url = explode('/', $urlHTTP);

    //VERIFICA QUAL A API SERÁ ENCAMINHADA A REQUISIÇÃO(contatos, estados, etc)
    switch(strtoupper($url[0])){
        case 'CONTATOS';
            require_once('contatosAPI/index.php');

            break;
    }




?>