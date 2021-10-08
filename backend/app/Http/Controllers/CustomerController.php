<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::orderBy('id_customer', 'DESC')->get();

        $response = [
          'message'   => 'List customer order by id_customer',
          'data'      => $customer
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
          'nama'          => ['required'],
          'contact'       => ['required', 'numeric'],
          'email'         => ['required', 'email'],
          'alamat'        => ['required'],
          'diskon'        => ['required', 'numeric'],
          'tipe_diskon'   => ['required', 'in:persentase,fix'],
          'ktp'           => ['required', 'image:jpeg,png,jpg,gif,svg'],
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $input = $request->all();
            $image = $request->file('ktp');
            $image_uploaded_path = $image->store('ktp', 'public');

            $input['ktp'] = basename($image_uploaded_path);
            
            $customer = Customer::create($input);

            $response = [
              'message'   => 'Customer created',
              'data'      => $customer
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
        $customer = Customer::findOrFail($id);

        $response = [
          'message'   => 'Detail of customer',
          'data'      => $customer
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
        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->all(), [
          'nama'          => ['required'],
          'contact'       => ['required', 'numeric'],
          'email'         => ['required', 'email'],
          'alamat'        => ['required'],
          'diskon'        => ['required', 'numeric'],
          'tipe_diskon'   => ['required', 'in:persentase,fix']
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $customer->update($request->all());

            $response = [
              'message'   => 'Customer updated',
              'data'      => $customer
            ];

            return response()->json($response, Response::HTTP_OK);
          } catch (QueryException $ex) {
            return response()->json([
              'message' => $ex->errorInfo
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
          }
        }
    }

    // Update ktp  customer
    public function ktp(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->all(), [
          'ktp' => ['required', 'image:jpeg,png,jpg,gif,svg']
        ]);

        if($validator->fails()){
          return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
          try {
            $ktp = $customer->first()->ktp;

            if (Storage::disk('public')->exists('ktp/'.$ktp)) {
              Storage::disk('public')->delete('ktp/'.$ktp);
            }

            $input = $request->all();
            $image = $request->file('ktp');
            $image_uploaded_path = $image->store('ktp', 'public');

            $input['ktp'] = basename($image_uploaded_path);
            
            $customer->update($input);

            $response = [
              'message'   => 'KTP customer updated',
              'data'      => $customer
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
        $customer = Customer::findOrFail($id);

        try {
          $customer->delete();

          $response = [
            'message'   => 'Customer deleted'
          ];

          return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $ex) {
          return response()->json([
            'message' => $ex->errorInfo
          ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
