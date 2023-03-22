<?php
namespace App\Ecommerce\Models;

use App\Ecommerce\Core\Model;

class Usuarios extends Model {
    protected $id;
    protected $nombre;
    protected $apellido;
    protected $nombre_usuario;
    protected $rolId = 1;
    protected $correo;
    protected $password;
    protected $stripeUserId;
    protected $created_at;
    protected $updated_at;

    public function __construct($data){
        $this->id =  (isset($data["id"]))? $data["id"] : null;
        $this->nombre = $data["nombre"];
        $this->apellido = $data["apellido"];
        $this->nombreUsuario = $data["usuario"];
        $this->rolId = $data["rolId"];
        $this->correo = $data["correo"];
        $this->password = $data["password"];
        $this->stripeUserId = $data["stripeId"];
        parent::__construct();
        $this->table = "usuarios";
    }

    public function geterTipoUsuario(){
         return $this->tipoUsuario;
    }
    public function seterTipoUsuario($tipo){
        $this->tipoUsuarioId = $tipo;
    }
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getNombreUsuario(){
        return $this->nombreUsuario;
    }
    public function getTipoUsuario(){
        return $this->rolId;
    }
    public function getCorreo(){
        return $this->correo;
    }
}
?>