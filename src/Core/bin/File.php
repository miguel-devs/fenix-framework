<?php 
namespace App\Ecommerce\Core\bin;

class File {
   
   private $name;
   private $rename;
   private $type;
   private $extension;
   private $size;
   private $tempName;


  public function set($fila){
    $this->name      = $_FILES[$fila]['name'];
    $this->type      = $_FILES[$fila]['type'];
    $this->size      = $_FILES[$fila]['size'];
    $this->tempName  = $_FILES[$fila]['tmp_name'];
    $this->extension = strtolower(pathinfo( $this->name, PATHINFO_EXTENSION ));

    return $this;
  }

   public function rename(){
      
      
       $this->rename = uniqid().time().".".$this->extension;
       return $this;

   }

   public function upload($ubicacion){
  
    if($this->rename){
        move_uploaded_file($this->tempName, $ubicacion . $this->rename);

    }else{
        move_uploaded_file($this->tempName, $ubicacion . $this->name);
    }
    return $this;
   }

   public function getName(){
     
    return $this->name;
   }
   public function getRename(){

    return $this->rename;
   }
   public function getHostUrl($url, $name){
    $host = $_SERVER["HTTP_HOST"];
    $urlComplete = "";
    if($url){
        $urlComplete = "http://" . $host ."/".$url.$name;
    }else{
        $urlComplete = "http://" . $host ."/".$name;
    }  
    return $urlComplete;  
   }
   public function delate(){

   }



}

?>