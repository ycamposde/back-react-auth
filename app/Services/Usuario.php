<?php
namespace App\Services;

use App\Repositories\Usuario as UsuarioRepository;

class Usuario {
    protected $usuarios;

    public function __construct(UsuarioRepository $usuarios) {
        $this->usuarios = $usuarios;
    }

    public function all() {
      return $this->usuarios->all();
    }

    public function store($data){
        return $this->usuarios->create($data);
    }

    public function update($data, $id){
        return $this->usuarios->update($data, $id);
    }

    public function delete($id){
        return $this->usuarios->delete($id);
    }

    public function paginate($perPage = 15, $columns = array('*'), $order_type = 'desc') {
        return $this->usuarios->paginate($perPage, $columns, $order_type);
    }

    public function find($id, $columns = array('*')) {
        return $this->usuarios->find($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*')) {
        return $this->usuarios->findBy($field, $value, $columns);
    }
}