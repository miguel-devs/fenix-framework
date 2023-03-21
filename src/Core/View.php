<?php
namespace App\Ecommerce\Core;

use Exception;


class View {

    /*Ubicacion Vista Predefinida*/
    public static $routePath = "src/Views/";
    static $section; 
    
    static function show($title,$view,$_data = []){

       try{
        foreach($_data as $key => $value ){
            if ($key === "_data"){
                 throw new Exception('Palabra reservada $_data, use otro nombre de variable');
            }
             $$key=$value;
        }
        require_once self::$routePath."AppLayout.php";
        
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
        
   }
   static function setSection($section){
              self::$section = $section;
   }
   static function activeView(string $string){
    if(self::$section == $string){
        return "active";
    }
}
}

?>