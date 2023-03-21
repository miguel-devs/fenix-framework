<?php
namespace App\Ecommerce\Models;

use App\Ecommerce\Models\Usuarios;

class clientes extends Usuarios {


   public function __construct($data){
      $this->table = "clientes";
      $this->id =  (isset($data["id"]))? $data["id"] : null;
      $this->nombre = $data["nombre"];
      $this->apellido = $data["apellido"];
      $this->nombreUsuario = $data["nombre_usuario"];
      $this->tipoUsuarioId = 2;
      $this->correo = $data["correo"];
      $this->password = $data["password"];
      $this->stripeUserId = 125566585252145;

      
   }

 
  

  


}

?>