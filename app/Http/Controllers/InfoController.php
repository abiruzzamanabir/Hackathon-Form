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
    public function update(Request $request, $id)
    {
        return $request->all();
        // Retrieve the user by email, assuming email is unique
        $user = User::where('google_id', $id)->firstOrFail();

        // Initialize members array
        $members = [];

        if ($request->member_name) {
            // Loop through member details and build the array
            foreach ($request->member_name as $key => $name) {
                $members[] = [
                    'member_name' => $name,
                    'member_designation' => $request->member_designation[$key],
                    'member_organization' => $request->member_organization[$key],
                    'member_contact' => $request->member_contact[$key],
                    'member_email' => $request->member_email[$key],
                ];
            }
        }

        // Update the user's data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'address' => $request->address,
            'members' => json_encode($members), // Encode members array once
        ]);

        // Redirect back with a success message
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
