<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//les fichier request sert a contraindres les informations qui peuvent son crée par l'utilisateur
//la c'est pour l'envoie du formulaire l'or de la creation d'une nouvelle categorie

class CreateCategoriesRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255','regex:/^[a-zA-Z\s]+$/', 'unique:categories,name','min:3','max:255'],
        ];
    }
    // cette function va permettre de definir les messages d'erreurs

    public function messages(): array{
        return [
            'name.required' => 'Le nom de la categorie est requis',
            'name.unique' => 'La categorie existe deja',
            'name.regex' => 'Le nom de la categorie doit contenir uniquement des lettres',
            'name.min' => 'Le nom de la categorie doit contenir au moins 3 caracteres',
            'name.max' => 'Le nom de la categorie doit contenir au plus 255 caracteres',
        ];
    }
    // c'est une methode magique qui permet de remplir les changes si utillisateur c'est tromper 
    // protected function prepareForValidation(){
    //     //$this->merge([
    //     //    'name' => strtolower($this->name),
    //     //]);
    // }
}
