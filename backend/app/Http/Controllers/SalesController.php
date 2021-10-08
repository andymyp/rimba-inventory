<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::orderBy('code_transaksi', 'DESC')->get();

        $response = [
          'message'   => 'List sales order by code_transaksi',
          'data'      => $sales
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
          'tanggal_transaksi'      => ['required'],
          'id_customer'            => ['required'],
          'total_diskon'           => ['required', 'numeric'],
          'total_harga'            => ['required', 'numeric'],
          'total_bayar'            => ['required', 'numeric'],
          'code_transaksi'         => ['required'],
          'id_item'                => ['required'],
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $sales = Sales::create();

            $response = [
              'message'   => 'Sales created',
              'data'      => $sales
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
