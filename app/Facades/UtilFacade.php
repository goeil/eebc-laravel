<?php
  
namespace App\Facades;
  
use Illuminate\Support\Facades\Facade;
  
class UtilFacade extends Facade {

    protected static function getFacadeAccessor() { 

        return 'util'; 
    }
}
