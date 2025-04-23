<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UtilServiceProviders extends ServiceProvider
{
  function __construct(){

  }
  function RandomString($n)
     {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randstring = '';
         for ($i = 0; $i < $n; $i++) {
             $randstring .= $characters[rand(0, strlen($characters)-1)];
         }
         return $randstring;
     }
    public function register()
    {
        //
    }


    public function boot()
    {
        //
    }
}
