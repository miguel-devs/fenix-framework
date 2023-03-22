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
    
   
    $data = [
      "nombre"   => $validator->setValuePost("nombre")->required()->sanitize("palabra")->maxLength(25)->minLength(4)->getValue(),
      "apellido" => $validator->setValuePost("apellido")->required()->sanitize("palabra")->maxLength(25)->minLength(4)->getValue(),
      "correo"   => $validator->setValuePost("correo")->unique("usuarios")->required()->isEmail()->getValue(),
      "usuario"  => $validator->setValuePost("usuario")->unique("usuarios")->required()->getValue(),
      "rolId"    => 2,
      "password" => $validator->setValuePost("password")->required()->getValue(),
     ];

    if($validator->error()){
      View::show("Registrar","Cliente/Create",["validator" =>$validator]);

    }else{
      $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);

      
      $customer = $stripe->customers->create([
        "email" =>  $data["correo"],
        'name' => $data["nombre"]." ".$data["apellido"],
      ]);

      
        $data["stripeId"] = $customer->id;
        $Usuarios = new Usuarios($data);
        $Usuarios->save($data);
        View::show("Registrar","Cliente/Create",["validator" =>$validator]);


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