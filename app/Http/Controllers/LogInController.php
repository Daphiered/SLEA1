<?php

namespace App\Http\Controllers;

use App\Models\LogIn;
use Illuminate\Http\Request;

class LogInController extends Controller
{
    public function index()
    {
        $logins = LogIn::latest('login_datetime')->paginate(10);
        return view('log-in.index', compact('logins'));

    }


    public function create()
    {
        return view('log-in.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email_address'  => ['required','email','max:255'],
            'user_role'      => ['nullable','in:admin,assessor,student'],
            'login_datetime' => ['nullable','date'],
        ]);

        // default login_datetime to now if empty
        if (empty($data['login_datetime'])) {
            $data['login_datetime'] = now();
        }

        $login = LogIn::create($data);

        return redirect()->route('log-in.show', $login->log_id)
                         ->with('success', 'Login record created.');
    }

   // app/Http/Controllers/LogInController.php
public function show(\App\Models\LogIn $log_in)
{
    $log_in->load(['logs' => fn($q) => $q->latest()->limit(50)]);
    return view('log-in.show', ['login' => $log_in]);
}


    public function destroy(LogIn $log_in)
    {
        $log_in->delete();
        return redirect()->route('log-in.index')->with('success', 'Login deleted.');
    }

}
