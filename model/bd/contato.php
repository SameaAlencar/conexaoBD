<?php
/**************************************
 * Objetivo: arquivo responsável por manipular os dados dentro do BD
 *    (insert, update, select e delete)
 * Autor: Samea
 * Data: 04/03/2022
 * Versão: 1.0
************************************/
//import do arquivo estabelece a conexão com o banco de dados
require_once('conexao.php');

//função para realizar o insert no BD
function insertContato($dadosContato){

    //declaraçãode variável para utilizar
    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();

//Monta o script para enviar para o BD
    $sql = "insert into tblcontatos
                (nome,
                telefone,
                celular,
                email,
                obs)
         values
               ('".$dadosContato['nome']."',
               '".$dadosContato['telefone']."',
               '".$dadosContato['celular']."',
               '".$dadosContato['email']."',
               '".$dadosContato['obs']."');";

//executa o script no BD

        

        // Validação para verificar se o script sql esta correto
        if (mysqli_query($conexao, $sql)){

            //Validação para verificar se uma linha foi acrescentada no BD
            if(mysqli_affected_rows($conexao))
              $statusResposta = true;
            else
              $statusResposta = false;
        }
        else{
            $statusResposta = false;
        }

        //solicita o fechamento da conexao com o banco de dados
        fecharConexaoMysql($conexao);
        return $statusResposta;
}

//função para realizar o update do BD
function updateContato(){

}

//função para excluir no BD
function deleteContato($id){

     //declaraçãode variável para utilizar
     $statusResposta = (boolean) false;

    //Abre a conexão com o banco de dados
    $conexao = conexaoMysql();

    //script para deletar um registro do banco de dados
    $sql = "delete from tblcontatos where idcontato =".$id;

    //valida se o script esta correto, sem erro de sintaxe e executa no BD
   if( mysqli_query($conexao, $sql)){


    if(mysqli_affected_rows(($conexao))){
        $statusResposta = true;
    }

    //fecha a conexão com o BD mysql
    fecharConexaoMysql($conexao);
    return $statusResposta;
   }

}

//função para listar todos os contatos do BD
function selectAllContato(){
    //Abre conexão com  BD
    $conexao = conexaoMysql();

    //script para listar todos os dados do BD
    $sql ="select * from tblcontatos order by idcontato desc";
    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $sql);

    //Valida se o BD retornou registros
    if($result)
    {
        //mysqli_fetch_assoc() - permite converter os dados para o BD em um array para manipulação do PHP
        //Nesta repetição estamos convertendo os dados do BD em um array ($rsDados), além de
        //o próprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a reperição
        $cont = 0;
        while($rsDados = mysqli_fetch_assoc($result)){
            
            //Cria um array com os dados do BD
            $arrayDados[$cont] = array(
                "id"        => $rsDados['idcontato'],
                "nome"      => $rsDados['nome'],
                "telefone"  => $rsDados['telefone'],
                "celular"   => $rsDados['celular'],
                "email"     => $rsDados['email'],
                "obs"       => $rsDados['obs']
            );
            $cont++;
        }
        //Solicita o fechamento da conexao com o BD
        fecharConexaoMysql($conexao);

        return $arrayDados;
    }

}


//função para editar um contato no BD através do id do registro
function selectByIdContato($id){
      //Abre conexão com  BD
      $conexao = conexaoMysql();

      //script para listar todos os dados do BD
      $sql ="select * from tblcontatos where idcontato = ".$id;

      //Executa o script sql no BD e guarda o retorno dos dados, se houver
      $result = mysqli_query($conexao, $sql);
  
      //Valida se o BD retornou registros
      if($result)
      {
          //mysqli_fetch_assoc() - permite converter os dados para o BD em um array para manipulação do PHP
          //Nesta repetição estamos convertendo os dados do BD em um array ($rsDados), além de
          //o próprio while conseguir gerenciar a quantidade de vezes que deverá ser feita a reperição
          
          if($rsDados = mysqli_fetch_assoc($result)){
              
              //Cria um array com os dados do BD
              $arrayDados = array(
                  "id"        => $rsDados['idcontato'],
                  "nome"      => $rsDados['nome'],
                  "telefone"  => $rsDados['telefone'],
                  "celular"   => $rsDados['celular'],
                  "email"     => $rsDados['email'],
                  "obs"       => $rsDados['obs']
              );
            
          }
          //Solicita o fechamento da conexao com o BD
          fecharConexaoMysql($conexao);
  
          return $arrayDados;
      }


}

    

?>