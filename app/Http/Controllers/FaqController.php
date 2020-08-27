<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Carbon\Carbon;


class FaqController extends Controller
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
        return view('admin.faq.index' , [
          'faq_all' => Faq::all(),
          'total_faq' => Faq::count(),
          'total_delete_all' => Faq::onlyTrashed()->get(),
          'faq_delete_total' => Faq::onlyTrashed()->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Faq::insert($request->except('_token') + [
          'created_at' => Carbon::now(),
        ]);
        return back()->with('success_status' , 'Your Faq Insert Successfully!!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.faq.edit' , [
          'faq_info' => Faq::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
         $faq->update();
         return back()->with('edit_status' , 'Update Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('trash_status' , 'Trash Successfully!!');
    }
    public function faqrestore($faq_id)
    {
        Faq::withTrashed()->find($faq_id)->restore();
        return back()->with('restore_status' , 'Restore Successfully!!');
    }
    public function faqdelete($faq_id)
    {
        Faq::withTrashed()->find($faq_id)->forceDelete();
        return back()->with('delete_status' , 'Delete Successfully!!');
    }
}
