<?php
// https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/#Directory_structure

namespace App\Repositories\Contracts;

interface RepositoryInterface
{

    public function all($columns = array('*'));

    public function paginate($perPage = 15, $columns = array('*'));

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = array('*'));

    public function findBy($field, $value, $columns = array('*'));
}