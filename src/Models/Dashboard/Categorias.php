<?php
namespace App\Ecommerce\Models\Dashboard;

use App\Ecommerce\Core\Model;

class Categorias extends Model{
   
    public function __construct(){
        parent::__construct();
        $this->table = "categorias";
    }
   
    


}