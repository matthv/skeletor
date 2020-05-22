<?php

namespace Matthv\Skeletor\Utils;

class Filter {

	public $name;

	public $options;

	public $choices;

	public $condition;

	public $value;

	public function __construct(string $name, array $options, $choices, $condition) {
		$this->name = $name;
		$this->options = $options;
		$this->choices = $choices;
		$this->condition = $condition;

		if (request()->has($this->name)) {
			$this->value = request()->input($this->name);
		}
	}



}
