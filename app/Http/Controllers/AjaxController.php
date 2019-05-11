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
}
