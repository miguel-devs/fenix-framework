<?php
namespace App\Ecommerce\Models\Dashboard;

use App\Ecommerce\Core\Model;


class Productos extends Model{
   
    private  $id;
    private string $nombre;
    private string $detalles;
    private string $precio;
    private string $activo;
    private string $categoriaId;
    private string $created_at;
    private string $update_at;

    public function __construct(){
        parent::__construct();
        $this->table = "productos";
    }
    


}
?>