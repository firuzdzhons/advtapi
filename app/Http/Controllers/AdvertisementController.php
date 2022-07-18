<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Http\Requests\UpdateAdvertisementRequest;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    const SORT_COLUMNS = array('price', 'created_at');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $advertisements = Advertisement::with('imageLinks');
        
        if ($this->hasSortParams($request->sort_by_column)) 
        {
            $sortDirection = isset($request->sort_direction) ? $request->sort_direction : 'asc';

            $advertisements->orderBy($request->sort_by_column, $sortDirection);
        }


        return $advertisements->paginate(4);
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

            return response([
                'status_code' => 200, 
                'message' => 'created',
                'id' => $advertisement->id,
            ], 200); 
        } catch (\Throwable $th) {
            return response([
                'status_code' => 500,
                'message' => $th->getMessage()
            ], 500);
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

    /**
     * check if query has nessary parametrs for sorting
     */
    private function hasSortParams($sortByColumn)
    {
        return isset($sortByColumn) && in_array($sortByColumn, self::SORT_COLUMNS);
    }
}
