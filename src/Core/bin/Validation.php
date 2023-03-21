<?php 
namespace App\Ecommerce\Core\bin;

Class Validation{
    private   $public = array();
    private   $messages = array();
    private   $error   = false ;
    private   $value ;
    private   $field ;
    private   $oldValues = array();
 

    public static $regexes = array(
        'fecha'        => '^[0-9]{1,2}[-/][0-9]{1,2}[-/][0-9]{4}$',
        'cantidad'      => '^[-]?[0-9]+$',
        'numero'      => '^[-]?[0-9,]+$',
        'alfanumerico'     => "^[0-9a-zA-Z ,.-_\\s\?\!]+\$",
        'palabra'       => "/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/",
        'telefono'       => '^[0-9]{10,11}$',
        'codigopostal'     => '^[1-9][0-9]{3}[a-zA-Z]{2}$',
        'plate'       => '^([0-9a-zA-Z]{2}[-]){2}[0-9a-zA-Z]{2}$',
        'precio'       => '^[0-9.,]*(([.,][-])|([.,][0-9]{2}))?$',
        'cualquircosa'    => "^[\d\D]{1,}\$",
    );

    public  function setValuePost($name){
           if(isset($_POST[$name])){
              $this->field = $name;
              $this->value = trim($_POST[$name]);
              $this->oldValues[$name] = $this->value; 
           }else{
             $this->value = null;
           }
           

		    return $this;
    }

    public function getValue(){
           return $this->value;
    }

    
    public  function required(){
          if(empty($this->value)){
            $this->error = true; 
            $this->messages[$this->field][] = "El campo ".$this->field." es requerido";
          }
          return $this; 
    }

    public  function minLength($min){
       if(strlen(  $this->value ) < $min ){
           $this->error = true; 
           $this->messages[$this->field][] = "El campo ".$this->field." debe tener un minimo de ".$min." caracteres";
       }
       return $this; 
    }

    public  function maxLength($max){
        if(strlen(  $this->value ) >= $max ){
            $this->error = true; 
            $this->messages[$this->field][] = "El campo ".$this->field." debe tener un maximo de ".$max." caracteres";
        }
        return $this; 
    }

    public function isEmail(){

            if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
                $this->error = true; 
                $this->messages[$this->field][] = "Correo no valido";
            }
            return $this;
        
    }


    public function sanitize($type){

        switch ($type) {
            case 'palabra':
                if($this->value){
                  if(preg_replace(self::$regexes[$type], '', $this->value)){
                    $this->error = true; 

                    $this->messages[$this->field][] = "No se admiten numeros";
                  }

                } 
                

                break;
            
            default:
                # code...
                break;
        }
        
        return $this;
    }    

    public function getOldValue($name){
        return (isset($this->oldValues[$name]))? $this->oldValues[$name] : null;
    }
    
    public function getMensajes(){
        if(!empty($this->messages)){
            return $this->messages;
        }
        return false;
    }

    public function getMensaje($name){
        if(isset($this->messages[$name])){
        $mensaje = $this->messages[$name][0];
        return $mensaje;
        }
        return; 
    }

    public function error(){
        return $this->error;
    }


}


?>