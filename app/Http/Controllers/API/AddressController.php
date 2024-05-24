<?php

namespace App\Http\Controllers\API;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function show($id)
    {
        $address=Address::find($id);
            if($address)
            {
                return response()->json([
                    'status'=>true,
                    'data'=>$address,
                    'message'=>'Address information'
                ]);
            }else
            {
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'message'=>'Address not found'
                ]);
            }
    }
    public function CreateAddress(Request $request)
    {
        $user = Auth::user();
        $address =new Address();
        $address->user_id=$user->id;
        $address->country=$request->get('country');
        $address->city=$request->get('city');
        $address->street=$request->get('street');
        $address->building=$request->get('building');
        $address->floor=$request->get('floor');
        $address->save();


        return response()->json([
            'status'=>true,
            'message'=>"address Registered successfully",
        ]);
    }
    public function update(Request $request,String $id)
    {
        $address = Address::find($id);
        $updateSuccess = $address->update($request->all());
        
        if ($updateSuccess) {
            $address = Address::find($id);
        }
        
        return response()->json([
            'status' => $updateSuccess,
            'data' => $address,
            'message' => $updateSuccess ? "Address updated Successfully" : "Update failed"
        ]);
        
    }
    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        if (!$address) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'address not found'
            ]);
        }

        $address->delete();
    
        return response()->json([
            'status' => true,
            'data' => null,
            'message' => 'address deleted successfully'
        ]);
    }
}
