<?php
namespace App\Ecommerce\Enums;

enum YesOrNot: string
{
    case Si = 'si';
    case No = 'no';


    public function label(): string
    {
        return match($this) {
            static::Si => 'si',
            static::No => 'no',
            
        };
    }
}

?>