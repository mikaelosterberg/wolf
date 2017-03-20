<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Howl;
use Auth;

class HowlRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'howl' => 'required|min:1|max:160', // Rule for Howl, Required, between 1 and 160 chars.
        ];
    }

    /**
     * Persist form data and return the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function persist()
    {
        $userId = Auth::user()->id;
        return Howl::PostHowl($userId, $this->only('howl'));
    }
}
