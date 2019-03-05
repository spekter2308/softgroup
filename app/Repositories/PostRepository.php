<?php

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Post as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository
 *
 * @package App\Repositories
 */
class PostRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	protected function getModelClass()
	{
		return Model::class;
	}
	/**
	 * Отримати список постів для виводу з пагінатором
	 *
	 * @param $perPage
	 * @return LengthAwarePaginator
	 */
	public function getAllWithPaginate($perPage)
	{
		$columns = [
			'id', 'title', 'slug', 'excerpt', 'is_published', 'published_at', 'user_id', 'deleted_at'
		];
		$result = $this->startConditions()
			->select($columns)
			->orderBy('id', 'DESC')
			->with([
				'user:id,name'
			])
			->paginate($perPage);
		return $result;
	}

	/**
	 * Отримати модель для відображення
	 *
	 * @param $id
	 * @return Model
	 */
	public function getPost($id)
	{
		return $this->startConditions()
			->with(['user:id,name'])
			->find($id);
	}

}

