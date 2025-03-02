<?php

namespace App\Http\Nomination;

use App\Models\Invoice;
use App\Models\nomination;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;

class InfoController extends Nomination
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
        return view('info.index', [
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
        return $request->all();
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
    public function update(Request $request, $id)
    {

        $update_date = User::findOrFail($id);


        $update_date->update([
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Comment Added');
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
