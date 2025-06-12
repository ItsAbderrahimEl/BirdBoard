<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ProjectInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('inviteTo', $this->route('project'));
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required', 'email', 'exists:users,email'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'The user with this email does not exist.',
        ];
    }
}
