<?php namespace App\Repositories;

use App\Repositories\Eloquent\Repository;

class Usuario extends Repository {

  function model()
  {
    return 'App\Models\Usuario';
  }
}