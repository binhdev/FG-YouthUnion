<?php

namespace App\Repositories;

use App\Lop;
use App\Http\Resources\LopResource;

class LopRepository
{
    /**
     * Get all of the objects for a given model.
     *
     * @return Collection
     */
    public function collection()
    {
        // Return collection of objects as a resource
        return LopResource::collection(Lop::orderBy('created_at', 'desc')->paginate(25));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Return object
        return new LopResource(Lop::findOrFail($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        // Return object
        return new LopResource(Lop::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $request | $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $lop = Lop::findOrFail($id);
        $lop->update($request->only(['name', 'desc', 'khoa_id']));
        // Return object
        return new LopResource($lop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $lop = Lop::findOrFail($id);
      $lop->delete();
      return response()->json([
          'meesage' => 'Delete #' . $id . ' successful!'
      ], 200);   
    }
}
