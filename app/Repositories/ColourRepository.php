<?php
namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ColourRepository extends BaseRepository
{
	/**
	 * Specify Model class name
	 *
	 * @return mixed
	 */
	function model()
	{
		return 'App\Models\Colour';
	}
}
