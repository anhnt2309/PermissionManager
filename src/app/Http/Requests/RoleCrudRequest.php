<?php namespace Backpack\Permissions\app\Http\Requests;

use App\Http\Requests\Request;

class RoleCrudRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// only allow updates if the user is logged in
		return \Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		
		$rules = [
			"name"=>"required",
			];

		return $rules;
	}
}
