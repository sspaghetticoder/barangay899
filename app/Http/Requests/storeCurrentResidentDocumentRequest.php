<?php

namespace App\Http\Requests;

use App\Rules\MobileNumber;
use Illuminate\Foundation\Http\FormRequest;

class storeCurrentResidentDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255|min:2',
            'suffix' => 'nullable|string|max:255',
            'house_number' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'email_add' => 'required|string|max:255',
            'contact_number' => ['required', 'numeric', 'digits:11', new MobileNumber],
            'cor' => 'nullable|string|max:1',
            'coi' => 'nullable|string|max:1',
            'bc' => 'nullable|string|max:1',
            'bp' => 'nullable|string|max:1',
            'business_name' => 'required_with:bp,on|string|max:255|nullable',
            'business_owner' => 'required_with:bp,on|string|max:255|nullable',
            'business_add' => 'required_with:bp,on|string|max:255|nullable',
            'business_nature' => 'required_with:bp,on|string|max:255|nullable',
            'sch' => 'nullable|string|max:255',
            'pas' => 'nullable|string|max:255',
            'gov' => 'nullable|string|max:255',
            'oth' => 'nullable|string|max:255',
            'purpose' => 'required_with:oth,on|string|max:255|nullable',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'last_name.required' => 'last name is required',
            'last_name.string' => 'last name must be a string',
            'last_name.max' => 'Max Characters: 255',
            'first_name.required' => 'first name is required',
            'first_name.string' => 'first name must be a string',
            'first_name.max' => 'Max Characters: 255',
            'middle_name.required' => 'middle name is required',
            'middle_name.string' => 'middle name must be a string',
            'middle_name.max' => 'Max Characters: 255',
            'house_number.required' => 'house number is required',
            'house_number.string' => 'house number must be a string',
            'house_number.max' => 'Max Characters: 255',
            'suffix.string' => 'suffix must be a string',
            'suffix.max' => 'Max Characters: 255',
            'street.required' => 'street is required',
            'street.string' => 'street must be a string',
            'street.max' => 'Max Characters: 255',
            'email_add.required' => 'email address is required',
            'email_add.string' => 'email address must be a string',
            'email_add.max' => 'Max Characters: 255',
            'contact_number.required' => 'contact number is required',
            'contact_number.numeric' => 'contact must be a number',
            'contact_number.digits' => 'Number of digits: 11',
            'business_name.required_with' => 'business name is required',
            'business_name.string' => 'business name must be a string',
            'business_name.max' => 'Max Characters: 255',
            'business_owner.required_with' => 'business owner is required',
            'business_owner.string' => 'business owner must be a string',
            'business_owner.max' => 'Max Characters: 255',
            'business_add.required_with' => 'business address is required',
            'business_add.string' => 'business address must be a string',
            'business_add.max' => 'Max Characters: 255',
            'business_nature.required_with' => 'business nature is required',
            'business_nature.string' => 'business nature must be a string',
            'business_nature.max' => 'Max Characters: 255',
            'purpose.required_with' => 'purpose is required',
            'purpose.string' => 'purpose must be a string',
            'purpose.max' => 'Max Characters: 255',
        ];
    }
}
