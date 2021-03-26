<?php

namespace App\Http\Requests\Record;

use App\Dictionaries\Record\SourcesDictionary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema()
 */
class CreateRecordRequest extends FormRequest
{

    /**
     * Name
     * @var string
     * @OA\Property()
     */
    public string $name;

    /**
     * Email
     * @var string
     * @OA\Property()
     */
    public string $email;

    /**
     * Phone
     * @var string
     * @OA\Property()
     */
    public string $phone;

    /**
     * Source
     * @var string
     * @OA\Property()
     */
    public string $source;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:128',
            'email' => 'required|string|email|max:128',
            'phone' => 'required|string|max:32',
            'source' => ['string', 'required', Rule::in( SourcesDictionary::availableSources() )],
        ];
    }
}
