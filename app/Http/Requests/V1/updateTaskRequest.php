<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class updateTaskRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT'){
        return [
            //
            'taskName'=>'required|alpha'
        ];
    }
        // else
        // {
        //     return[
        //     'taskName'=>'required|alpha'
        //     ];
        // }
    }

    public function messages()
    {
        return [
            "taskName.required"=> "Name of task required"
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge(
        [
          'name' => $this->taskName  //allows us to get data into db
       
        ]);
    }
    
}
