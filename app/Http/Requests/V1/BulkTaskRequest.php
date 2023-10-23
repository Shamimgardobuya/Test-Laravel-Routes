<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulkTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            '*.taskName'=>'required|alpha',
            '*.taskIdentifier'=>'required|numeric'

        ];
    }

    public function messages()
    {
        return [
            "taskName.required"=> "Name of task required"
        ];
    }
    protected function prepareForValidation()
    {
        // $this->merge(
        // [
        //   'name' => $this->taskName  //allows us to get data into db
       
        // ]);
        $data = [];
        foreach($this->toArray() as $obj)
        {
           $obj['id'] = $obj['taskIdentifier'] ?? null;
           $obj['name'] = $obj['taskName'];

            $data[]  = $obj;

         }
         $this->merge($data);
    
}

}
