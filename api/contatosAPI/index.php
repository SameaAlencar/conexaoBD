<?php

/**
 * $request - recebe dados do corpo da requisição (JSON, FROM/DATA, XML, etc)
 * $response - envia dados de retorno da API
 * $args - permite receber dados de atributos na api
 */

//import do arquivo autoload, que fara as intancias do slim
require_once('vendor/autoload.php');

//Criando um objeto do slim chamado app, para configurar os EndPoints
$app = new \Slim\App();

//endpoint: requisição para listar todos os contatos 
$app->get('/contatos', function($request, $response, $args){
    require_once('../modulo/config.php');
    //import da controler contatos que fara a busca de dados
    require_once('../controller/controllerContatos.php');

          //solicita os dados da controller
          if($dados = listarContato()){

            //verifica se houve algum tipo de erro no retorno dos dados na controller
            if(!isset($dados['idErro'])){
              //realiza a conversao do array de dados em formato JSON
                    if($dadosJSON = createJSON($dados))
                    {
                        //caso exista dados a serem retornados, informamos o statusCode200 e 
                        //enviamos um JSON com todos os dados encontrados
                    return $response ->withStatus(200)
                                        ->withHeader('Content-Type','application/json')
                                        ->write($dadosJSON);

                    }
            }else{
              //Converte para JSON  o erro, pois a controller retorna em array
              $dadosJSON= createJSON($dados);

              return $response ->withStatus(404)
                                ->withHeader('Content-Type','application/json')
                                ->write('{"message": "Dados inválidos",
                                          "Erro": '.$dadosJSON.'
                                        }');
            }
          }else{
              //retorna um statusCode que significa que a requisicao foi aceita, porem sem
              //conteudo de retoro
                return $response    ->withStatus(204);
                                  
          }

        });
        
//endpoint: requisição para listar todos os contatos com id
$app->get('/contatos/{id}', function($request, $response, $args){

    //recebe o id do registro que deverá ser retornado pela API
    //OBS: Esse id está chegando pela variável criada no endpoint
    $id = $args['id'];

    require_once('../modulo/config.php');
    require_once('../controller/controllerContatos.php');

    if($dados = editarContato($id))
    {
        if($dadosJSON = createJSon($dados))
        return $response ->withStatus(200)
                            ->withHeader('Content-Type','application/json')
                            ->write($dadosJSON);
    }else{
        
         return $response    ->withStatus(204);
                           
    }

});
//endpoint: requisição para inserir um novo contato 
$app->post('/contatos', function($request, $response, $args){

});

    $app->run();

?>