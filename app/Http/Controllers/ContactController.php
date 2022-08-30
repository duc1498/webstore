<?php

namespace App\Http\Controllers;

use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SoftDeletes;
use App\Models\Setting;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $contact = Contact::all();
        $data = $request->all();
        $filter_type = $data['filter_type'] ?? 2;
            if(Auth::user()->role_id ==1) {
                if($filter_type == 1){
                    $contact = Contact::withTrashed()->latest()->paginate(10);
                }elseif($filter_type == 2) {
                    $contact = Contact::latest()->paginate(10);
                }else {
                    $contact = Contact::onlyTrashed()->latest()->paginate(10);
                }
            }else {
                $contact = Contact::latest()->paginate(10);
            }

        return view('backend.contact.index', compact('contact','filter_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
        $contact = Contact::findOrFail($id);

        return view('backend.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $data= $request->all();
        $contact = Contact::findOrFail($id);

        $contact ->update($data);

        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        Contact::destroy($id);
        if($contact) {
            @unlink(public_path($contact->image));
            Contact::destroy($id);
            return response()->json([
                'success' => true,
                'msg' => 'xoá thành công '
            ]);
        } else {
            return response()->json([
                'success' => false,
                'msg' => 'xoá không thành công '
            ], 500);
        }

      return true;

    }
    public function contact()
    {
        //
        $setting = Setting::first();
        return view('frontend.layouts.contant', compact('setting'));
    }

    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
            return response()->json([
                'status' => true,
                'msg' => 'Khôi phục thành công '
            ]);
    }
}
