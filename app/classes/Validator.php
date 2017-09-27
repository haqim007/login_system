<?php


class Validator
{
	protected $db;

	protected $errorHandler;

	protected $rules = ['required', 'minlength', 'maxlength', 'unique', 'email' ];

	protected $messages = [
		'required' => 'the :field field is required',
		'minlength' => 'the :field field must be a minimum of :satisfier characters',
		'maxlength' => 'the :field field must be a maximum of :satisfier characters',
		'email' => 'email is not valid',
		'unique' => 'that :field is already taken'
	];

	public function __construct(Database $db, ErrorHandler $errorHandler)
	{
		$this->db = $db;
		$this->errorHandler = $errorHandler;

	}
	public function check($items, $rules)
	{
		foreach ($items as $item => $value) {
			if (in_array($item, array_keys($rules))) 
			{
				$this->validate([
					'field' => $item,
					'value' => $value,
					'rules' => $rules[$item]
				]);	
			}
		}

		return $this;
	}

	public function fails()
	{
		return $this->errorHandler->hasErrors();
	}

	public function errors()
	{
		return $this->errorHandler;
	}

	protected function validate($item)
	{
		$field = $item['field'];
		foreach ($item['rules'] as $rule => $satisfier) {
			if (in_array($rule, $this->rules)) {
				if (!call_user_func_array([$this, $rule], [$field, $item['value'], $satisfier])) 
				{
					//error msg
					$this->errorHandler->addError(
						str_replace([':field', ':satisfier'], [$field, $satisfier], $this->messages[$rule]),
						$field
					);
				}
			}
		}
	}

	protected function required($field, $value, $satisfier)
	{
		return !empty(trim($value));
	}

	protected function minlength($field, $value, $satisfier)
	{
		return mb_strlen($value) >= $satisfier;
	}

	protected function maxlength($field, $value, $satisfier)
	{
		return mb_strlen($value) <= $satisfier;
	}
	protected function email($field, $value, $satisfier)
	{
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	protected function unique($field, $value, $satisfier)
	{
		return !$this->db->table($satisfier)->exists([
			$field => $value
		]);
	}
}