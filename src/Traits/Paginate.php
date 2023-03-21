<?php
namespace App\Ecommerce\Traits;

trait Paginate{
    public function paginate(){
        $paginateUrl = [];
        if($_GET){
            if(isset($_GET["inicio"])){
                $this->inicio = $_GET["inicio"];
               array_push($paginateUrl,$this->inicio);
            }
            if(isset($_GET["limite"])){
                $this->limite = $_GET["limite"];
                array_push($paginateUrl,$this->limite);
            }
             
        }else{
            $this->inicio = 0;
            $this->limite = 10;

            $paginateUrl = [$this->inicio,10];
        }
        return $paginateUrl;
    }
    private function htmlLinks($data){
        $preview =$data['urlPreview'];
        $next = $data['urlNext'];
        $urls = $data["urls"];
        $i=1;
        $html = "";
        
        $html .= "<a href=\"$preview\">Anterior</a>";
        foreach($urls as  $url){
            $html .= "<a href=\"$url\">$i</a>";
        $i++;
       }
        $html .= "<a href=\"$next\">Siguiente</a>";
        return $html; 
    }
    public function links($total = 10){
        $totalLinks = round(($total/$this->limite));
        $detener = $this->limite * ($totalLinks-1);
        $data       = [];
        $urls       = [];
       
        $next       = ($this->inicio < $detener)? $this->inicio + $this->limite : $this->inicio ; 
        $preview    = ($this->inicio >0 )? $this->inicio - $this->limite : $this->inicio = 0 ;

        for($i = 0; $i < $totalLinks; $i++){
        $inicio =   $this->limite * $i;  
        $urls[] = "/?inicio=$inicio&limite=$this->limite";
        }

        $urlNext    = "/?inicio=$next&limite=$this->limite";
        $urlPreview = "/?inicio=$preview&limite=$this->limite" ;
        $data["urls"] = $urls;
        $data["urlNext"] = $urlNext;
        $data["urlPreview"] = $urlPreview;
        return self::htmlLinks($data); 
        

    }
}

?>