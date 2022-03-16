<?php

namespace App\Http\Requests;

use App\Rules\MobileNumber;
use Illuminate\Foundation\Http\FormRequest;

class storeNewResidentDocumentRequest extends FormRequest
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
            'alias' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'citizenship' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'religion' => 'required|string|max:255',
            'blood_type' => 'nullable|string|max:255',
            'pwd' => 'required|string|max:255',
            'years_of_residence' => 'nullable|numeric',
            'member_4ps' => 'required|string|max:255',
            'voter_status' => 'required|string|max:255',
            'identified_as' => 'required|string|max:255',
            'street_name' => 'required|string|max:255',
            'email_add' => 'required|string|max:255',
            'emp_stat' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'emp_name' => 'nullable|string|max:255',
            'monthly_income' => 'nullable|numeric',
            'floor_no' => 'nullable|string|max:255',
            'block_no' => 'nullable|string|max:255',
            'family_relation' => 'required|string|max:255',
            'sss_no' => 'nullable|string|max:255',
            'tin_no' => 'nullable|string|max:255',
            'gsis_no' => 'nullable|string|max:255',
            'pagibig_no' => 'nullable|string|max:255',
            'philhealth_no' => 'nullable|string|max:255',
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
            'suffix.string' => 'suffix must be a string',
            'suffix.max' => 'Max Characters: 255',
            'alias.string' => 'nickname must be a string',
            'alias.max' => 'Max Characters: 255',
            'birth_date.required' => 'middle name is required',
            'birth_date.date' => 'birthdate must be date',
            'place_of_birth.required' => 'birthplace is required',
            'place_of_birth.string' => 'birthplace must be a string',
            'place_of_birth.max' => 'Max Characters: 255',
            'sex.required' => 'sex is required',
            'sex.string' => 'sex must be a string',
            'sex.max' => 'Max Characters: 255',
            'citizenship.required' => 'citizenship is required',
            'citizenship.string' => 'citizenship must be a string',
            'citizenship.max' => 'Max Characters: 255',
            'civil_status.required' => 'civil status is required',
            'civil_status.string' => 'civil status must be a string',
            'civil_status.max' => 'Max Characters: 255',
            'religion.required' => 'religion is required',
            'religion.string' => 'religion must be a string',
            'religion.max' => 'Max Characters: 255',
            'blood_type.string' => 'blood type must be a string',
            'blood_type.max' => 'Max Characters: 255',
            'pwd.required' => 'pwd is required',
            'pwd.string' => 'pwd field must be a string',
            'pwd.max' => 'Max Characters: 255',
            'years_of_residence.numeric' => 'years of residence must be a numeric',
            'member_4ps.required' => 'member of 4ps field is required',
            'member_4ps.string' => 'member of 4ps field must be a string',
            'member_4ps.max' => 'Max Characters: 255',
            'voter_status.required' => 'voter status is required',
            'voter_status.string' => 'voter status must be a string',
            'voter_status.max' => 'Max Characters: 255',
            'identified_as.required' => 'identified as field is required',
            'identified_as.string' => 'identified as field must be a string',
            'identified_as.max' => 'Max Characters: 255',
            'house_number.required' => 'house number is required',
            'house_number.string' => 'house number must be a string',
            'house_number.max' => 'Max Characters: 255',
            'street_name.required' => 'street is required',
            'street_name.string' => 'street must be a string',
            'street_name.max' => 'Max Characters: 255',
            'email_add.required' => 'email address is required',
            'email_add.string' => 'email address must be a string',
            'email_add.max' => 'Max Characters: 255',
            'emp_stat.required' => 'employment status is required',
            'emp_stat.string' => 'employment status must be a string',
            'emp_stat.max' => 'Max Characters: 255',
            'occupation.string' => 'occupation must be a string',
            'occupation.max' => 'Max Characters: 255',
            'emp_name.string' => 'occupation must be a string',
            'emp_name.max' => 'Max Characters: 255',
            'monthly_income.numeric' => 'monthly_income must be a numeric',
            'floor_no.string' => 'floor must be a string',
            'floor_no.max' => 'Max Characters: 255',
            'block_no.string' => 'block must be a string',
            'block_no.max' => 'Max Characters: 255',
            'family_relation.required' => 'family relation field is required',
            'family_relation.string' => 'family relation field must be a string',
            'family_relation.max' => 'Max Characters: 255',
            'sss_no.string' => 'sss must be a string',
            'sss_no.max' => 'Max Characters: 255',
            'tin_no.string' => 'tin must be a string',
            'tin_no.max' => 'Max Characters: 255',
            'gsis_no.string' => 'gsis must be a string',
            'gsis_no.max' => 'Max Characters: 255',
            'pagibig_no.string' => 'pagibig must be a string',
            'pagibig_no.max' => 'Max Characters: 255',
            'philhealth_no.string' => 'philhealth must be a string',
            'philhealth_no.max' => 'Max Characters: 255',
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
