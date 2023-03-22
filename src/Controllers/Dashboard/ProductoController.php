<?php 
namespace App\Ecommerce\Controllers\Dashboard;

use App\Ecommerce\Core\View;
use App\Ecommerce\Core\bin\File;
use App\Ecommerce\Enums\YesOrNot;
use App\Ecommerce\Core\Controller;
use App\Ecommerce\Models\Imagenes;
use App\Ecommerce\Traits\Paginate;
use App\Ecommerce\Core\bin\Validation;
use App\Ecommerce\Models\Dashboard\Productos;
use App\Ecommerce\Models\Dashboard\Categorias;

class ProductoController extends Controller{
     
    use Paginate;
    private $Productos;
    private $Categorias;
    private $Imagenes;

    public function __construct(){
        View::$routePath = "src/Views/Dashboard/";
        View::setSection("Productos");
        $this->Productos = new Productos;
        $this->Categorias = new Categorias;
        $this->Imagenes   = new Imagenes;
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
        $validar = new Validation;
        $file = new File;
        $urlImageProduct="assets/imagenes/productos/";

        $dataImagenes = [$file->set("imagenPrincipal")->rename()->upload($urlImageProduct)->getRename(),$file->set("imagenSecundaria")->rename()->upload($urlImageProduct)->getRename()];

        $dataUrlImagen = [];
        foreach($dataImagenes as $imagen){
             $dataUrlImagen [] = $file->getHostUrl($urlImageProduct,$imagen);
        }

        
        $producto = [
            "nombre" => $validar->setValuePost("nombre")->getValue(),
            "detalles"=> $validar->setValuePost("detalles")->getValue(),
            "precio"=> $validar->setValuePost("precio")->getValue(),
            "activo"=> $validar->setValuePost("activo")->getValue(),
            "categoriaId"=> $validar->setValuePost("categoriaId")->getValue(),
         ];
    
        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);

      
      //            "images" => ["https://www.jonatan-cmtz.com/imagenes/3_Dxq7QS_400x400.jpg","https://www.jonatan-cmtz.com/imagenes/3_Dxq7QS_400x400.jpg"],
//            "images" => [$dataUrlImagen[0],$dataUrlImagen[1]],

       $productoStripe =  $stripe->products->create([
            'name' => $producto["nombre"],
            "active" => true,
            "description" => $producto["detalles"],
            "images" => ["https://www.jonatan-cmtz.com/imagenes/3_Dxq7QS_400x400.jpg","https://www.jonatan-cmtz.com/imagenes/3_Dxq7QS_400x400.jpg"]

        ]);
        
        $producto["stripeProductId"] = $productoStripe->id;
        $stripePrecio = $producto["precio"] * 100;
        $precio = $stripe->prices->create([
            'unit_amount' => $stripePrecio,
            'currency' => 'mxn',
            'product' => $productoStripe->id,
        ]);
        
        $stripe->products->update(
            $productoStripe->id,
            ['default_price' => $precio->id ]
        );
       

         $id = $this->Productos->saveReturnId($producto);
        if($id){
            foreach ($dataImagenes as $imagen){
                $this->Imagenes->save(["nombre" => $imagen,"productoId"=> $id]);
            }
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