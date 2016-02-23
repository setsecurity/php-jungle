<?php
namespace core\utils;

trait FilterValidationTrait{
    
    /*FILTERS*/
    
    public function filterAlphaNum($value){
        $value=(string)preg_replace('/[^A-Z0-9_]/i','',$value);
        return trim($value);
    }
    
    /*VALIDATIONS*/
    
     public function validateInt($int){
        if(!filter_var($int,FILTER_VALIDATE_INT))return false;
        return true;
    }
    
    public function validateEmail($email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))return false;
        return true;
    }
    
    public function validateAlphaNum($value){
        if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $value))return true;
        return false;
    }

    public function validateLength($value,$min=1,$max=30){
       $value=strlen($value);
       if($value>=$min && $value<=$max)return true;
       return false;
    }
    
    public function validateImg($img){
        if(preg_match('/.*(jpg|png|gif)$/i)', $img))return true;
        return false;
    }
    
    /**
     * Valida que el string no contenga etiquetas html
     * @param type $value
     * @return boolean
     */
    public function validateStripTags($value){
        $filtered=strip_tags($value);
        if($value!=$filtered)return false;
        return true;
    }
    
}
