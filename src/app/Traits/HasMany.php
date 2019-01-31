<?php

namespace Matthv\Skeletor\App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasMany {

	/**
	 * @param array $arrayValues
	 * @param Model $entity
	 * @param string $method
	 * @return Model
	 */
	public function saveMany(array $arrayValues, Model $entity, string $method): Model {
		$collect = [];
		foreach($arrayValues as $value) {
			array_push($collect, ($entity->$method()->getQuery()->getModel())->newInstance($value));
		}
		$entity->$method()->saveMany($collect);
		return $entity;
	}

	public function maxRelations(array $relations, int $max): array {
        foreach($relations as $key => $value) {
            if ($key >= $max) unset($relations[$key]);
        }
        return $relations;
    }

}