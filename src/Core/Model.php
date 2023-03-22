<?php
namespace App\Ecommerce\Core;

use App\Ecommerce\Core\Db;
use App\Ecommerce\Traits\ArrayFunctions;
use App\Ecommerce\Traits\StringFunctions;

class Model {
    use ArrayFunctions;
    use StringFunctions;
    private $conn;
    protected $table;
    protected $dataModel;

    public function __construct(){
        $db = new Db();
       
        $this->conn = $db->conn;
       

    }

    
    private function concatColumnsByKey($data){
        $endKey = Model::endKey( $data );
        $sql =  "";
        foreach($data as $clave => $valor){
          if($clave == $endKey ){
            $sql .= $clave;
          }else{
            $sql .= $clave. ", " ;
          }
        }
        return $sql;
      }
  
      private function concatColumns($columnas){
        $cadena = " ";
        foreach($columnas as $clave => $columna){
          if($clave == count($columnas) - 1  ){
          $cadena .= $columna;
          }else{
            $cadena .= $columna.", ";
          }
       }
       return $cadena;
      }
  
      private function concatValues($valores){
        $endKey = Model::endKey( $valores );
        $sql = " (";
        foreach($valores as $clave => $valor){
          if($clave == $endKey ){
          $sql .= ":".$clave;
          }else{
            $sql .= ":".$clave.", " ;
          }
        }
        $sql .= ")";
        return $sql;
      }
  
      private function concatColumnAndValue($data){
        $endKey = Model::endKey( $data );
  
        $sql = " ";
        foreach($data as $clave => $valor){
          if($clave == $endKey ){
          $sql .= $clave." = ". ":".$clave;
          }else{
            $sql .= $clave . " = ".":".$clave.", " ;
          }
        }
        $sql .= " ";
        return $sql;
      }
  
      private function getColumnsTable($tablas){
        $columnas = [];
        foreach($tablas as $tabla){ 
          $sql = "SELECT Column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME =  '$tabla'";
          $res = $this->conn->prepare($sql);
          $res->execute();
          $datos = $res->fetchall();
          foreach($datos as $dato){
            $cadena = $tabla.".".$dato["Column_name"];
            $columnas[] = $cadena;
            
          }
        }
         $cadena = "";
         foreach($columnas as $clave => $columna){
            if($clave == count($columnas) - 1  ){
            $cadena .= $columna;
            }else{
              $cadena .= $columna.", ";
            }
         }
         return $cadena;
      }
  
      private function linkLimit(){
        return $totalElementos = self::getCount();
  
      }
  
  
      public function getByID(int $id){
         $sql ="SELECT * FROM $this->table WHERE id = :id";
         $res = $this->conn->prepare($sql);
         $res->bindValue(":id", $id);
         $res->execute();
         $datos = $res->fetch();
         return $datos;
      }
  
      
  
      public function innerJoin($columns = [] , $tables = [], $order = null, $limit = []){
        
        $sql = "SELECT ";
        if(empty($columns)){
            $sql .= " $this->table.*, ";
            $sql.=self::getColumnsTable($tables);
  
        }else{
           $sql .= self::concatColumns($columns);
        }
        $sql.= " FROM $this->table ";
        foreach($tables as $table){
          $sql.= " INNER JOIN $table ";
        }
        foreach($tables as $tableInnerJoin){
          $tableInnerSingularID = Model::getPalabraSingular($tableInnerJoin);
          $sql .=" ON $this->table.$tableInnerSingularID"."Id"." = $tableInnerJoin.id ";
        }
        if($order){
          $sql.= " ORDER BY  ".$order. " ";
        }
        if($limit){
          $sql.= " LIMIT ";
          $sql .= self::concatColumns($limit);
        }
        $res = $this->conn->prepare($sql);
        $res->execute();
        $datos = $res->fetchAll();
       
     
        return $datos;
      }
  
      public function getAll(){
        $sql = "SELECT * FROM $this->table";
        $res = $this->conn->prepare($sql);
        $res->execute();
        $datos = $res->fetchAll();
        return $datos;
      }
  
      public function getCount(){
        $sql = "SELECT COUNT(*) AS total FROM $this->table";
        $res = $this->conn->prepare($sql);
        $res->execute();
        $datos = $res->fetch();
        return $datos["total"];
      }
  
      public function save($data){

        $sql = "INSERT INTO $this->table  ";
        $sql .= "(";
        $sql .=  self::concatColumnsByKey($data); 
        $sql .= ") VALUES ";
        $sql .=  self::concatValues($data); 
        $res = $this->conn->prepare($sql);
        return $res->execute($data);

      }

      public function saveReturnId($data){

        $sql = "INSERT INTO $this->table  ";
        $sql .= "(";
        $sql .=  self::concatColumnsByKey($data); 
        $sql .= ") VALUES ";
        $sql .=  self::concatValues($data); 
        $res = $this->conn->prepare($sql);
        $res->execute($data);
        $lastId = $this->conn->lastInsertId();
        return $lastId; 
      }

      public function whereOr($columnas = []){

        $endKey = Model::endKey( $columnas );

        if(!empty($columnas)){
          $sql = "SELECT * FROM $this->table ";
          $sql .= " WHERE ";
          foreach($columnas as $clave => $valor){
            if($clave == $endKey ){
              $sql .= $clave." = '". $valor."'"  ;
            }else{
              $sql .= $clave." = '". $valor. "' || " ;
            }
          }
          $res = $this->conn->prepare($sql);
          return  $res->execute();

        }
      }

      public function where($columnas = []){

        $endKey = Model::endKey( $columnas );

        if(!empty($columnas)){
          $sql = "SELECT * FROM $this->table ";
          $sql .= " WHERE ";
          foreach($columnas as $clave => $valor){
            if($clave == $endKey ){
              $sql .= $clave." = '". $valor."'"  ;
            }else{
              $sql .= $clave." = '". $valor. "' || " ;
            }
          }
          $res = $this->conn->prepare($sql);
         return $res->execute();

        }
      }

     
  
    
  
      public function update($id,$data){
       
        $sql ="UPDATE $this->table SET ";
        $sql .= self::concatColumnAndValue($data);
        $sql .= "WHERE id = :id ";
        $res = $this->conn->prepare($sql);
  
        foreach($data as $clave => $valor){
          $res->bindValue(":".$clave, $valor);
        }
        $res->bindValue(":id", $id);
        return $res->execute();
  
      }
  
  
      public function delate($id){
       
        $sql ="DELETE FROM $this->table WHERE id = :id ";
        $res = $this->conn->prepare($sql);
        $res->bindValue(":id", $id);
        return $res->execute();
  
      }
  
      
  }
  

?>