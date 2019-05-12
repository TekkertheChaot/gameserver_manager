<?php

namespace App\Http\Controllers;

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
        $links = \App\Link::all();
        $users = \App\User::all();
        $groups = \App\Group::all();
        $usergroups = \App\Group::all();
        $servers = \App\Server::all();
        return view('home', ['links' => $links, 'users' => $users, 'usergroups' => $usergroups, 'groups' => $groups, 'servers' => $servers]);
    }
}
