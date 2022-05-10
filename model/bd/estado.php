<?php

/**************************************
 * Objetivo: arquivo responsável por manipular os dados dentro do BD
 *    (select )
 * Autor: Samea
 * Data: 10/05/2022
 * Versão: 1.0
************************************/

//import do arquivo estabelece a conexão com o banco de dados
require_once('conexao.php');

//função para listar todos os contatos do BD
function selectAllEstados(){
    //Abre conexão com  BD
    $conexao = conexaoMysql();

    //script para listar todos os dados do BD
    $sql ="select * from tblestados order by idestado desc";
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
                "idestado"        => $rsDados['idestado'],
                "nome"            => $rsDados['nome'],
                "sigla"           => $rsDados['sigla']
            );
            $cont++;
        }
        //Solicita o fechamento da conexao com o BD
        fecharConexaoMysql($conexao);

        if(isset($arrayDados))
            return $arrayDados;
        else
            return false;
    }

}

?>