<?php

namespace Matthv\Skeletor\App\Traits;


use Matthv\Skeletor\App\Utils\Filter;
use Matthv\Skeletor\App\Utils\FiltersCollection;

trait Filters {

	public $filters = [];

	/**
	 * @param string $name
	 * @param array $options
	 * @param $choices
	 * @param $condition
	 * @return $this
	 */
	public function addFilter(string $name, array $options, $choices, $condition) {
		if (is_array($this->filters)) $this->enableFilters();
		if (is_callable($choices)) $choices = $choices();
		$this->filters->push(new Filter($name, $options, $choices, $condition));

		if (request()->has($name) && !is_null(request()->input($name))) {
			$this->filters->active = true;
			$condition(request()->input($name));
		}

		return $this;
	}

	public function enableFilters() {
		$this->filters = new FiltersCollection();
	}

	/**
	 * @return array
	 */
	public function getFilters() {
		return $this->filters;
	}

	/**
	 * @param $function
	 * @return mixed
	 */
	public function addCondition($function) {
		return call_user_func_array([$this->query, $function], array_slice(func_get_args(), 1));
	}

}
