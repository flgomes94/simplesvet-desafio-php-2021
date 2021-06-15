<?php
namespace Src\helpers;

class Formaters {
    public function format_telefone($telefone){
        return trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));
    }
}