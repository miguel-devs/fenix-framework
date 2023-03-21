<?php
namespace App\Ecommerce\Core;

Class Controller{
   
   
    private $_data ;

 

    protected function redirect($url = ""){
        header("Location:".$url);
    }
  
}

?>