<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Advertisement::simplePaginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdvertisementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertisementRequest $request)
    {
        try {
            $advertisement = Advertisement::create($request->except('image_links'));

            foreach($request->image_links as $link) {
                $advertisement->imageLinks()->create([
                    'link' => $link
                ]);
            } 

            return response(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return $advertisement->load('imageLinks');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdvertisementRequest  $request
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertisementRequest $request, Advertisement $advertisement)
    {
        try {
           $advertisement->update($request->validated());

           return response(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        try {
            $advertisement->delete();

            return response(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
