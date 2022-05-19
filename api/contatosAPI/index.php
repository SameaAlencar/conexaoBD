<?php

  //Import so arquivo autoload, que fará as instâncias do slim
    require_once('vendor/autoload.php');
  //Criando um objeto do slim chamado app, para configurar o EndPoint

    $app = new \Slim\App();

  //EndPoint: Requisição para listar todos os contatos
    $app->get('/contatos', function($request, $response, $args){

    });







?>