<?php
namespace Src\helpers;

use Src\helpers\Formaters;

class Validators {
    public function email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function telefone($telefone){
        $formater = new Formaters();
        $telefone_formatado = $formater->format_telefone($telefone);
        $valid=true;
        if(strlen($telefone_formatado) <= 9 || strlen($telefone_formatado) >= 12){
            $valid=false;
        }
        if(strlen($telefone_formatado) == 10 && ($telefone_formatado[2] >= '6' && $telefone_formatado[2] <= '9')){
            //adiciona o nono dígito se for celular
            $telefone_formatado = substr_replace($telefone_formatado,'9', 3,0);
        }
        if($telefone_formatado[2] >= '6' && $telefone_formatado[2] <= '9'){
            $tipo = 'celular';
        }else{
            $tipo = 'fixo';
        }
        $telefone_formatado = substr_replace($telefone_formatado,'(', 0,0);
        $telefone_formatado = substr_replace($telefone_formatado,')', 3,0);
        $telefone_formatado = substr_replace($telefone_formatado,' ', 4,0);
        $telefone_formatado = substr_replace($telefone_formatado,'-', -4,0);
        return array("telefone"=>$telefone_formatado, "tipo" =>$tipo, "valid"=>$valid);
    }
}