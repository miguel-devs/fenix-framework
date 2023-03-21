<?php 
namespace App\Ecommerce\Controllers\Dashboard;

use App\Ecommerce\Core\View;
use App\Ecommerce\Enums\YesOrNot;
use App\Ecommerce\Core\Controller;
use App\Ecommerce\Traits\Paginate;
use App\Ecommerce\Models\Dashboard\Productos;
use App\Ecommerce\Models\Dashboard\Categorias;

class ProductoController extends Controller{
     
    use Paginate;
    private $Productos;
    private $Categorias;

    public function __construct(){
        View::$routePath = "src/Views/Dashboard/";
        View::setSection("Productos");
        $this->Productos = new Productos;
        $this->Categorias = new Categorias;
    }

    public function index(){
        $columns = ["productos.*", "categorias.nombre as nombreCategoria"];
        $tables = ["categorias"];
        $order = null;
        $paginateUrl = ProductoController::paginate();

        $total = $this->Productos->getCount();
        $datos = $this->Productos->innerJoin($columns,$tables,$order,$paginateUrl);
        $links = ProductoController::links($this->Productos->getCount());

        View::show("Mis productos","Productos/Index",["datos"=>$datos,"links"=>$links]);
    }

    public function create(){
        $categorias = $this->Categorias->getAll();
        $opcionesActive = YesOrNot::cases();
        View::show("Crear producto","Productos/Create",["categorias"=>$categorias,"opcionesActive"=>$opcionesActive]);
    }

    public function store(){
           if($this->Productos->save($_POST)){
            parent::redirect("/");
           }else{
            parent::redirect("/producto/create");
           }
    }

    public function edit($id){
        $producto = $this->Productos->getByID($id); 
        $categorias = $this->Categorias->getAll();
        $opcionesActive = YesOrNot::cases();
        View::show("Editar producto","Productos\Edit",["categorias"=>$categorias,"opcionesActive"=>$opcionesActive,"producto"=>$producto]);

    }

    public function update($id){
           $this->Productos->update($id,$_POST);
           parent::redirect("/");
    }

    public function delete($id){
        $this->Productos->delate($id);
        parent::redirect("/");

 }
    
}

?>