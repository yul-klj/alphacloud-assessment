<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBidRequest;
use App\Services\BidService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Controller class BidController
 *
 * @package App\Http\Controllers\Api
 */
class BidController extends Controller
{
    public function create(CreateBidRequest $request)
    {
        $bidService = new BidService();
        $bid = $bidService->createBid($request->user_id, $request->price);

        return $this->successRespond(
            [
                'full_name' => $bid->user->full_name,
                'price' => number_format($bid->price, 2, '.', '')
            ],
            'Success',
            Response::HTTP_CREATED
        );
    }
}
