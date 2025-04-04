<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        return [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'estado' => 'required',
            'fecha_limite' => 'required|date|after_or_equal:today',
        ];
    }
    public function messages()
    {
        return [
            // 'titulo.required' => 'El titulo es obligatorio.',
            // 'descripcion.required' => 'La descripcion es obligatoria.',
            // 'estado.required' => 'El estado es obligatorio.',
        ];
    }
    public function attributes()
    {
        return [
            'titulo' => 'Título',
            'descripcion' => 'Descripción',
            'estado' => 'Estado',
            'fecha_limite' => 'Fecha límite',
        ];
    }
}
