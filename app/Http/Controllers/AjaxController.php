<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once('./../app/Joking/testclass.php');

class AjaxController extends Controller
{
    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getUsersPage(Request $request)
    {
        return \View::make('management/users')->render();
    }

    public function getGroupsPage(Request $request)
    {
        return \View::make('management/groups')->render();
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
    public function getAddUserDialog(Request $request)
    {
        return \View::make('management/users/addUser')->render();
    }
    public function getPrivsPage(Request $request)
    {
        return \View::make('management/privileges')->render();
    }
    public function getServerInformation(String $id)
    {
        return \View::make('home/serverInfo', ['id' => $id])->render();
    }

}
