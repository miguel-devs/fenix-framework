<?php
namespace App\Ecommerce\Traits;

trait StringFunctions
{
     function getPalabraSingular($palabra){
        $singular='';
            for($i=0;$i<strlen($palabra);$i++){
                if($i<strlen($palabra)-1){
                   $singular .= $palabra[$i];
				}
        }
        return $singular;
    }
}


?>

