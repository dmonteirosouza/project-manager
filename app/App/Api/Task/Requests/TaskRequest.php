<?php


namespace App\Api\Task\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'start' => ['required', 'date'],
            'finish' => ['required', 'date'],
        ];
    }
}
