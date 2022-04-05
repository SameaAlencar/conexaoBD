<?php

/********************************************
 * Objetivo: Arquivo de rota, para segmentar as ações encaminhadas pela View
 *    (dados de um form, listagem de dados, ação de excluir ou atualizar).
 *    Esse arquivo será responsável por encaminhar as solicitações para 
 *    encaminhar a Controller
 * Autor: Samea
 * Data:  04/03/2022
 * Versão:1.0
 ********************************************/

    $action = (string) null;
    $componente = (string) null;

    //Validação para verificar se a requisição é um
    //POST de um formulário
    if($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] =='GET')
    {
        //recebendo dados via URL para saber quem tá solicitando e qual ação
        // será realizada

        $componente = strtoupper($_GET['componente']);
        $action = strtoupper($_GET['action']);


        //Estrutura condicional para validar quem esta solicitando algo para o Rout
        switch($componente)
        {
            case 'CONTATOS':
                
                //import da controller Contatos
                require_once('controller/controllerContatos.php');

                //Validação para identificar o tipo de ação a ser realizada
               if($action == 'INSERIR'){

                //Chama a função de inserir controller
                 $resposta = inserirContato($_POST);

                 //Valida o tipo de dados que a controller retornou
                 if(is_bool($resposta)){ //se for bolleano

                    //Verificar se o retorno foi verdadeiro
                    if($resposta)
                    echo("<script>
                    alert('Registro inserido com sucesso');
                    window.location.href = 'index.php';
                        </script>");
                 
                  //Se o retorno foi array significa que houve um erro no processo de inserção
                }elseif(is_array($resposta))
                 echo("<script>
                    alert('".$resposta['message']."');
                    window.history.back();
                     </script>");
         }elseif($action == 'DELETAR'){
            
            //recebe o id do registro que deverá ser excluído, que foi enviado pela url
            //no link da imagem do excluir que foi acionado na index
            $idContato = $_GET['id'];
            $resposta = excluirContato($idContato);

            if(is_bool($resposta)){

              
               if(is_bool($resposta)){
                  echo("<script>
                    alert('Registro excluido com sucesso!');
                    window.location.href='index.php';
                     </script>");
               
               }elseif(is_array($resposta)){
                  echo("<script>
                    alert('".$resposta['message']."');
                    window.history.back();
                     </script>");


               }
               

            }
         }elseif($action == 'EDITAR'){

            //recebe o id do registro que deverá ser excluído, que foi enviado pela url
            //no link da imagem do excluir que foi acionado na index
            $idContato = $_GET['id'];

            //chama a função editar na controller
            $dados = editarContato($idContato);

            //ativa a utilização de variáveis de sessão no servidor
           session_start();

           //Guarda em uma variável de sessão os dados que o BD retornou para a busca do id
             //Obs: essa variavél de sessão será utilizada na index.php, para colocar os dados nas caixas de texto
           $_SESSION['dadosContato'] = $dados;

           //Utilizando o header também poderemos chamar a index.php
           //porem haverá uma ação de carregamento no navegador
           //(piscando a tela nivamente)
           //ex: header('location:index.php');

           //utilizando o require iremos apenas importar a tela da index,
            // assim não havendo um novo carregamento da página
           require_once('index.php');

         }

           break;
        }
           
   }

?>