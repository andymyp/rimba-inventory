<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('id_item', 'DESC')->get();

        $response = [
          'message'   => 'List items order by id_item',
          'data'      => $items
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'nama_item'       => ['required'],
          'unit'            => ['required', 'in:kg,pcs'],
          'stok'            => ['required', 'numeric'],
          'harga_satuan'    => ['required', 'numeric'],
          'barang'          => ['required', 'image:jpeg,png,jpg,gif,svg'],
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $input = $request->all();
            $image = $request->file('barang');
            $image_uploaded_path = $image->store('items', 'public');

            $input['barang'] = basename($image_uploaded_path);
            
            $item = Item::create($input);

            $response = [
              'message'   => 'Item created',
              'data'      => $item
            ];

            return response()->json($response, Response::HTTP_CREATED);
          } catch (QueryException $ex) {
            return response()->json([
              'message' => $ex->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);

        $response = [
          'message'   => 'Detail of item',
          'data'      => $item
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validator = Validator::make($request->all(), [
          'nama_item'       => ['required'],
          'unit'            => ['required', 'in:kg,pcs'],
          'stok'            => ['required', 'numeric'],
          'harga_satuan'    => ['required', 'numeric']
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $item->update($request->all());

            $response = [
              'message'   => 'Item updated',
              'data'      => $item
            ];

            return response()->json($response, Response::HTTP_OK);
          } catch (QueryException $ex) {
            return response()->json([
              'message' => $ex->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
          }
        }
    }

    // Update image barang
    public function image(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $validator = Validator::make($request->all(), [
          'barang' => ['required', 'image:jpeg,png,jpg,gif,svg']
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $barang = $item->first()->barang;

            if (Storage::disk('public')->exists('items/'.$barang)) {
              Storage::disk('public')->delete('items/'.$barang);
            }

            $input = $request->all();
            $image = $request->file('barang');
            $image_uploaded_path = $image->store('items', 'public');

            $input['barang'] = basename($image_uploaded_path);
            
            $item->update($input);

            $response = [
              'message'   => 'Image item updated',
              'data'      => $item
            ];

            return response()->json($response, Response::HTTP_OK);
          } catch (QueryException $ex) {
            return response()->json([
              'message' => $ex->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
          }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        try {
          
          $barang = $item->first()->barang;
          
          if (Storage::disk('public')->exists('items/'.$barang)) {
            Storage::disk('public')->delete('items/'.$barang);
          }
          
          $item->delete();
          
          $response = [
            'message'   => 'Item deleted'
          ];

          return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $ex) {
          return response()->json([
            'message' => $ex->errorInfo
          ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
