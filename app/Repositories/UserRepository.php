<?php

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\User as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository
{
	/**
	 * @return string
	 */
	protected function getModelClass()
	{
		return Model::class;
	}

	/**
	 * Отримати всіх користувачів з ролями
	 *
	 * @return mixed
	 */
	public function getAllUsers()
	{
		$columns = [
			'id', 'name', 'email'
		];

		$result = $this->startConditions()
			->select($columns)
			->orderBy('id', 'DESC')
			->with([
				'roles:role_id,name'
			])
			->get();

		return $result;
	}

	public function getUser($id)
	{
		return $this->startConditions()
			->with([
				'roles:role_id,name'
			])
			->find($id);
	}

}

