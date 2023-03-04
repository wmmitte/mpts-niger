<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserHandlerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        return $user->role === 'admin' ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'genre' => 'required',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image',
            'entity_id' => 'required'
        ];
    }
}
