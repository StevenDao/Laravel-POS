<?php
// https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/#Directory_structure

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Repository;

class ProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\Products';
    }
}
