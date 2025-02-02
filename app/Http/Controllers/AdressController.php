<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Order_product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Requestadress;
use App\Models\AddressType;
use Illuminate\Http\Request;

class AdressController extends Controller
{
    public function create(Requestadress  $request)
    {
        $cart = Order_product::all();
        $user = auth::user();
        $users = $user->id;
 
        $address = Address::create([
            'city'          => $request->city,
            'district'      => $request->district,
            'street'        => $request->street,
            'number'        => $request->number,
            'zipcode'       => $request->zipcode,
            'complement'    => $request->complement,
            'user_id'       => $users,
            'fhone'          => $request->fhone,
            // 'address_type_id' => $request->address_type

        ]);

        //criar campo na tabela address_types

        $addTypes = $request->address_type;

        $addTypeCreate = AddressType::create([
           'name' =>  $addTypes,
        ]);


         //criar tabela pivor address_user_id

         $addType = $addTypeCreate->id;
         $addressId = $address->id;


         $address->addressUserTypes()->create([
            'user_id'         => auth()->id(),
            'address_type_id' => $addType,
            'address_id'      => $addressId, // Incluir o address_id associado ao endereço recém-criado
        ]);



        // $addressType = AddressType::findOrFail($request->address_type);
        // $addressType->users()->attach($user->id);

        return redirect()->route('cart.show', compact('user', 'cart'))
            ->with('success', 'Endereço Cadastrado com sucesso');
    }


}
