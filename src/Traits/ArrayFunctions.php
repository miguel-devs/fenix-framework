<?php
namespace App\Ecommerce\Traits;

trait ArrayFunctions
{
    function endKey( $array ){

        //Aquí utilizamos end() para poner el puntero
        //en el último elemento, no para devolver su valor
        end( $array );
    
        return key( $array );
    
    }
}


?>

