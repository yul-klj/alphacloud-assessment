<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Services\BidService;
use Illuminate\Validation\Validator;

/**
 * Request Class CreateBidRequest
 *
 * @package App\Http\Requests
 */
class CreateBidRequest extends Request
{
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
        $highestPrice = app(BidService::class)->getHighestBid();
        return [
            'user_id' => ['required', 'exists:users,id'],
            'price' => ['required', 'decimal:0,2', 'gt:' . $highestPrice+1],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'price.required' => 'The bid price is required!',
            'price.decimal' => 'The price format is invalid.',
            'price.gt' => 'The bid price cannot lower than :value',
        ];
    }
}
