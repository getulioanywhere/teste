<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XRequest extends FormRequest
{
    // public function getValidatorInstance() {
    //     dd($this->getInputSource());
    // }
    /**
	 * [prepareForValidation Method call from trait Illuminate\Validation\ValidatesWhenResolvedTrait]
	 * @return [type] [ Prepare de request to before call the rules method ]
	 */
	// public function prepareForValidation()
	// {
        // dd(request());
		// if(is_string($this->slugfy))
		// {
		// 	$this->mergeSlug($this->slugfy);
		// }

		// if(is_string($this->active))
		// {
		// 	$this->merge(['active' => $this->has($this->active)]);
		// }

		// if(is_string($this->bagname))
		// {
		// 	$this->errorBag = $this->bagname;
		// }

		// if($this->has('bagname'))
		// {
		// 	$this->errorBag = $this->get('bagname');
		// }
	// }

}