<?php
/********************************************
 * Objetivo: Aequivo para criar a conexão com o BD Mysql
 * Autor:Samea
 * Data:25/02/2002
 * Versão:1.0 
 *********************************************/


 //constantes para estabelecer a conexão com o BD (local do BD, usuário, senha e database)
const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbcontatos';

//$resultado = conexaoMysql();
//echo('<pre>');
//var_dump($resultado);
//echo('</pre>');
 // Abre a conexão com o BD Mysql
function conexaoMysql()
{
    $conexao = array();

    //se a conexão for estabelecida com o bd, iremos ter um array de dados sobre a conexão
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    //validação para verificar se a conexão foi realizada com sucesso
    if($conexao){
        return $conexao;
    }else{
        return false;
    }


}

    function fecharConexaoMysql($conexao){
        mysqli_close($conexao);

  }
// Existem 3 formas de criar a conexão com o BD Mysql
// mysql_connect() - versão antiga do PHP de fazer a conexão com BD(NÃO OFERECE PERFORMANCE E SEGURANÇA)
// mysqli_connect() - versão mais atualizada do php de fazer a conexão com o BD(PERMITE SER UTILIZADA PARA PROGRAMAÇÃO ESTRUTURADA E POO)
// PDO() - versão mais completa e eficiente para conexão com BD(É INDICADA PELA SEGURANÇA E POO)







?>