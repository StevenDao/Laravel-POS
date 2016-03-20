<?php
// https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/#Directory_structure

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProductRepository extends BaseRepository
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
