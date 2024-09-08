<?php

namespace App\Http\Requests\Todo;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /**
         * The location coordinates.
         */
        return [
            /**
             * The name of the task.
             * @var string $task_name
             * @example Buy lamborghini
             */
            'task_name' => 'required',

            /**
             * The completion status of the task.
             * @var boolean $is_completed
             * @example false
             */
            'is_completed' => 'required|boolean'
        ];
    }
}
