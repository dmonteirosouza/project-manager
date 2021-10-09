<?php


namespace App\Api\Project\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
