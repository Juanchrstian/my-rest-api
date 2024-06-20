<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Cupcake;

class CupcakeController extends Controller
{
    /**
     * Display a listing of the item.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cupcake::get();
    }

    /**
     * Store a newly created item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cupcake = new Cupcake;
            $cupcake->fill($request->validated())->save();

            return $cupcake;

        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Display the specified item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cupcake = Cupcake::findOrfail($id);

        return $cupcake;
    }

    /**
     * Update the specified item in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $cupcake = Cupcake::find($id);
           $cupcake->fill($request->validated())->save();

           return $cupcake;

        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data - {$exception->getMessage}");
        }
    }

    /**
     * Remove the specified item from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cupcake = Cupcake::findOrfail($id);
        $cupcake->delete();

        return response()->json(null, 204);
    }
}