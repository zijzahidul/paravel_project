<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerEmail;

class CustomerEmailController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('checkrole');
  }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customeremail.index' , [
          'customeremail_info' => CustomerEmail::all(),
          'customeremail_total' => CustomerEmail::count(),
        ]);
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
