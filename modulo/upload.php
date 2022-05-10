<?php
/**************************************
 * Objetivo: arquivo responsável por realizar uploads de arquivos
 *  obs(este arquivo fará a ponte entre a View e a model)
 * Autor: Samea
 * Data: 04/03/2022
 * Versão: 1.0
************************************/

//função para realizar opload de imagem
function uploadFile($arrayFile){
    require_once('modulo/config.php');

    $arquivo = $arrayFile;
    $sizeFile = (int)  0;
    $typeFile = (string)  null;
    $nameFile = (string)  null;
    $tempFile = (string) null;

    //validação para identificar se existe um arquivo válido maior que 0 e que tenha uma extensão
    if($arquivo['size'] > 0 && $arquivo['type'] != ""){

        //Recupera o tamanho do arquivo que é em bytes e converte para kb(/1024)
        $sizeFile = $arquivo['size']/1024;
        //Recupera o tipo do arquivo
        $typeFile = $arquivo['type'];
        //Recupera o nome do arquivo
        $nameFile = $arquivo['name'];
        //Recupera o caminho do diretorio temporario que está no arquivo
        $tempFile = $arquivo['tmp_name'];

        

        //validação para permitir upload apenas de arquivos no máximo 5mb
        if($sizeFile < MAX_FILE_UPLOAD){

            //Validação para permitir somente as extenções válidas
            if(in_array($typeFile, EXT_FILE_UPLOAD)){

                //separa somente o nome do arquivo sem a sua extensão
                $nome = pathinfo($nameFile, PATHINFO_FILENAME);

                //separa somente a extensão do arquivo sem o seu nome
                $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                //existem diversos algoritmos para criptografia de dados
                    //md5()
                    //sha1()
                    //hash()

                //md5() gerando uma criptografia de dado
                //uniqid() gerando uma sequencia numérica diferente tendo como base, configurações da maquina
                //time() pega a hora, minuto e segundo que está sendo o upload da foto

                $nomeCripty = md5($nome.uniqid(time()));

                //montamos novamente o nome do arquivo com a extensão
                $foto = $nomeCripty. ".".$extensao;

                //envia o arquivo da pasta temporaria do apache para a pasta criada no projeto
                if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto)){

                    return $foto;
                }else{
                    return array('idErro'   =>13,
                     'message'  =>'Não foi possível mover o arquivo para o servidor');

                }

            }else{
                return array('idErro'   =>12,
                     'message'  =>'A extensão do arquivo selecionado não é permitida no upload.');

            }


        }else{
            return array('idErro'   =>10,
                         'message'  =>'Tamanho de arquivo inválido no upload.');
        }

    }else{
        return array('idErro'   =>11,
                     'message'  =>'Não é possível realizar o upload sem um arquivo selecionado.');

    }

}

?>