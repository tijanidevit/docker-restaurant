<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all()->sortByDesc('id');
        return response([
            'status' => 1,
            'message' => "All restaurants fetched",
            'data' => $restaurants,
        ]);
    }

    public function store(RestaurantRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $data['image'] = $this->uploadImageToCloudinary('image');
    
            $restaurant = Restaurant::create($data);
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
    public function show($id)
    {
        try {
            $restaurant = Restaurant::find($id);
            if (!$restaurant) {
                return response([
                    'status' => 0,
                    'message' => "Restaurant not found",
                ]);
            }

            $restaurant->products;
            $restaurant->user;
            $restaurant->total_orders = $restaurant->orders()->count();
            return response([
                'status' => 1,
                'message' => "Restaurant fetched successfully",
                'data' => $restaurant,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 0,
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function update($id,RestaurantRequest $request)
    {
        try {
            $restaurant = Restaurant::find($id);
            $data = $request->validated();

            if (!$restaurant) {
                return response([
                    'status' => 0,
                    'message' => "Restaurant not found",
                ]);
            }
            if ($request->has('image')) {
                $restaurant->image = $this->uploadImageToCloudinary('image');
            }
            $restaurant->name = $request->name;
            $restaurant->location = $request->location;
            $restaurant->email = $request->email;
            $restaurant->phone = $request->phone;
            $restaurant->description = $request->description;
            $restaurant->save();
            return response([
                'status' => 1,
                'message' => "Restaurant updated successfully",
                'data' => $restaurant,
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 0,
                'message' => $ex->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $restaurant = Restaurant::find($id);
            if (!$restaurant) {
                return response([
                    'status' => 0,
                    'message' => "Restaurant not found",
                ]);
            }
            $restaurant->delete();
            return response([
                'status' => 1,
                'message' => "Restaurant deleted successfully",
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 0,
                'message' => $ex->getMessage(),
            ]);
        }
    }
    
    public function search($name)
    {
        try {
            $restaurants = Restaurant::where('name','like',"%$name%")->get();
            dd($restaurants);
            if (empty($restaurants)) {
                return response([
                    'status' => 0,
                    'message' => "No restaurants found",
                ]);
            }
            return response([
                'status' => 1,
                'message' => "Restaurants searched successfully",
                'data' => $restaurants
            ]);
        } catch (\Exception $ex) {
            return response([
                'status' => 0,
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
