<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
require_once('./../app/SSH/SSHComunicator.php');
require_once('./../app/Privileges/PrivilegeProvider.php');

class GroupsController extends Controller
{
    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }
    public function inspectGroup(String $groupName, Request $request){
        
        $username = $request->request->get('username');
        if($username != null){
            return \View::make('management/groups/inspectGroup', ['groupName' => $groupName])->render();
        } else {
            return 'Call could not be authorized';
        }
    }
}