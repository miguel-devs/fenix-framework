<?php
namespace App\Ecommerce\Controllers;

use App\Ecommerce\Core\View;
use App\Ecommerce\Enums\YesOrNot;
use App\Ecommerce\Core\Controller;
use App\Ecommerce\Models\Clientes;
use App\Ecommerce\Models\Usuarios;
use App\Ecommerce\Traits\Paginate;
use App\Ecommerce\Core\bin\Validation;


class ClienteController extends Controller {
  public function __construct(){
    View::setSection("Productos");

    View::$routePath = "src/Views/Tienda/";
}

  public function login(){

  }

  public function index(){
    
  }

  public function create(){
    $validator = new Validation;


    View::show("Registrar","Cliente/Create",["validator" =>$validator]);


  }
  public function store(){
 
    $validator = new Validation;
    
    try{
   
    $data = [
      "nombre"   => $validator->setValuePost("nombre")->required()->sanitize("palabra")->maxLength(25)->minLength(4)->getValue(),
      "apellido" => $validator->setValuePost("apellido")->required()->sanitize("palabra")->maxLength(25)->minLength(4)->getValue(),
      "usuario"  => $validator->setValuePost("usuario")->required()->getValue(),
      "rolId"    => 2,
      "correo"   => $validator->setValuePost("correo")->required()->isEmail()->getValue(),
      "password" => $validator->setValuePost("password")->required()->getValue(),
     ];
    if($validator->error()){
      View::show("Registrar","Cliente/Create",["validator" =>$validator]);

    }else{
        $Usuarios = new Usuarios($data); 
        if($Usuarios->save($data)){
          //View::show("Index","Cliente/In",["validator" =>$validator]);
        //  parent::redirect("/tienda/");

        }else{

        }

    }
   
    
   
  
    }catch(Exception  $e){
       echo "Hubo un error";
    }
   
  }

  public function edit(){

  }
  
  public function update($id){

  }

  public function delate($id){

  }

    
}

?>