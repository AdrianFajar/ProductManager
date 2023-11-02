<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        $profile = User::find($id);

        return view('account.profile', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->id);
        User::where('id', $id)
        ->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->dob,
            'gender' => $request->gender,
        ]);


        return redirect('home');
    }
}
