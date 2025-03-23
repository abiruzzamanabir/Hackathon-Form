<?php

namespace App\Http\Controllers;

use App\Mail\MakePaymentMail;
use App\Models\Invoice;
use App\Models\Nomination;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function update(Request $request, $email)
    {
        // Retrieve the user by email, assuming email is unique
        $user = User::where('email', $email)->firstOrFail();
        // Initialize members array
        $members = [];

        if ($request->member_name) {
            // Loop through member details and build the array
            foreach ($request->member_name as $key => $name) {
                $members[] = [
                    'member_name' => $name,
                    'member_designation' => $request->member_designation[$key],
                    // 'member_organization' => $request->member_organization[$key],
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
            'team_name' => $request->team_name,
            'category' => $request->category,
            'members' => json_encode($members), // Encode members array once
            'isUpdated' => true,
        ]);

        $user_data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'ukey' => $request->id,
            'designation' => $request->designation,
            'organization' => $request->organization,
            'all_members' => json_encode($members),
        ];

        Mail::to($request->email)->queue(new MakePaymentMail($user_data));

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

    public function banUser($id)
    {
        $data = User::findOrFail($id);


        if ($data->isBlocked) {
            $data->update([
                'isBlocked' => false,
            ]);
        } else {
            $data->update([
                'isBlocked' => true,
            ]);
        }
        return back()->with('success', 'Ban updated successfully');
    }
    public function toggleBan($id)
    {
        $user = User::findOrFail($id);

        // Toggle the isBlocked status
        $user->isBlocked = !$user->isBlocked;
        $user->save();

        return response()->json(['isBlocked' => $user->isBlocked]);
    }
    public function resetIsUpdated($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        $user->isUpdated = false;
        $user->save();

        return response()->json(['success' => true]);
    }
    public function resetIsSubmitted($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }

        $user->isSubmitted = false;
        $user->save();

        return response()->json(['success' => true]);
    }
}
