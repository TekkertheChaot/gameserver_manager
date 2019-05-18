<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagementController extends Controller

{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if(!$this->isUserAllowedToVisitPage()){
            return redirect('home');
        } else {
            return view('management');
        }
    }

    public function getUsersPage(Request $request)
    {
        return \View::make('management/users')->render();
    }
    public function getServersPage(Request $request)
    {
        return \View::make('management/servers')->render();
    }
    public function getGamesPage(Request $request)
    {
        return \View::make('management/games')->render();
    }
    public function getHostsPage(Request $request)
    {
        return \View::make('management/hosts')->render();
    }
    public function getCredsPage(Request $request)
    {
        return \View::make('management/creds')->render();
    }
    public function getPrivsPage(Request $request)
    {
        return \View::make('management/privileges')->render();
    }

    protected function isUserAllowedToVisitPage(){
        $step = 0;
        $currentUser = \App\User::where('username', Auth::user()->username)->get();
        if($currentUser[0] != null){
            $step = 1;
            $adminGroups = \App\Group::where('group_name', 'admins')->get();
            if($adminGroups[0] != null){
                $step = 3;
                $current_user_id = $currentUser[0]->user_id;
                $users_group_ids = \App\User_Group::where('user_id', $current_user_id)->get();
                foreach($users_group_ids as $user_group_id){
                    if($user_group_id->group_id == $adminGroups[0]->group_id){
                        $step = 3;
                        return true;
                    }
                }
            }
        }
        
        return false;
    }
}