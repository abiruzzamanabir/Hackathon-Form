<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\nomination;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = Invoice::get()->unique('name');
        $theme = Theme::findOrFail(1);
        return view('nomination.index', [
            'form_type' => 'store',
            'invoices' => $invoice,
            'theme' => $theme,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function show(nomination $nomination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function edit(nomination $nomination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, nomination $nomination)
    {
        $update_date = User::findOrFail($request->email);
        $members = [];
        if ($request->member_name) {
            for ($i = 0; $i < count($request->member_name); $i++) {
                array_push($members, [
                    'member_name' => $request->member_name[$i],
                    'member_designation' => $request->member_designation[$i],
                    'member_organization' => $request->member_organization[$i],
                    'member_contact' => $request->member_contact[$i],
                    'member_email' => $request->member_email[$i],
                    'members' => json_encode($members),
                ]);
            }
        }
        $update_date->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'address' => $request->address,
            'members' => json_encode($members),
        ]);

        return redirect()->route('form.index')->with('success', 'Information Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(nomination $nomination)
    {
        //
    }
}
