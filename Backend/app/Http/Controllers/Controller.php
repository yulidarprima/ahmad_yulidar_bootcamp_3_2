<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function bookUnit(Request $request) 
{
DB::beginTransaction();

try 
{
$this->validate($request, [
'Kamar_Id' => 'required',
'Customer_Id' => 'required',
'Check_In' => 'required',
'Check_Out' => 'required'

]);

$KamarID = $request->input('Kamar_Id');
$CustomerID = $request->input('Customer_Id');
$CheckIn = $request->input('Check_In');
$CheckOut = $request->input('Check_Out');

DB::table('transaksis')->insert([
['Kamar_Id' => $KamarID, 'Customer_Id' =>CustomerID,
'Check_In' => $CheckIn, 'Check_Out' => $CheckOut]
]);


$rent = DB::table('transaksis')->select(transaksis.transaksis_id, transaksis.Customer_Id, transaksis.kamar_id, 
transaksis.Check_In, transaksis.Check_Out)->get();

DB::commit();
return response()->json($rent, 200);
}

catch(\Exception $e) 
{
DB::rollBack();
return response()->json(["message" => $e->getMessage()], 500);
} 
}
}
