<?php

namespace App\Http\Controllers;

include_once('./../app/Privileges/PrivilegeProvider.php');
use Illuminate\Http\Request;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        $currentUser = \App\User::where('username', \Auth::user()->username)->first();
        $effectivePerms = \PrivilegeProvider::getEffectivePrivilegesForUser($currentUser->user_id);

        // give view the variables
        $servers = \App\Server::all();
        return view('home', ['currentUser' => $currentUser, 'servers' => $servers, 'permissions' => $effectivePerms]);
    }

}