<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantProductRequest;
use App\Models\RestaurantProduct;
use Illuminate\Http\Request;

class RestaurantProductController extends Controller
{
    public function store(RestaurantProductRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $restaurant = $user->restaurant;
            $data['image'] = $this->uploadImageToCloudinary('image');
    
            $restaurant = RestaurantProduct::create($data);
            if (!$restaurant) {
                return response([
                    'status' => 0,
                    'message' => "Unable to create restaurant",
                ]);
            }
            return response([
                'status' => 1,
                'message' => "Restaurant created successfully",
                'data' => $restaurant,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 0,
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
