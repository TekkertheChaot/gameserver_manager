<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GroupController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function addGroup(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddUserVaild($request)){
                $newUser = new \App\User;
                $newUser->username = $request->request->get('group_name');
                $newUser->email = $request->request->get('email');
                $newUser->password = Hash::make($request->request->get('password'));
                $newUser->save();
                $result = array('ok' => true, 'message' => 'User successfully created.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editUser(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditUserVaild($request)){
                $user_id = $request->request->get('user_id');
                $oldUser = \App\User::where('username', $user_id)->get()[0];
                $oldUser->username = $request->request->get('username');
                $oldUser->email = $request->request->get('email');
                $oldUser->password = Hash::make($request->request->get('password'));
                $oldUser->save();
                $result = array('ok' => true, 'message' => 'User successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteUser(Request $request){
        if($this->isCallAuthorized($request)){
            $username = $request->request->get('username');
            $email = $request->request->get('username');
            $password = $request->request->get('username');
            $passwordHashed = Hash::make($password);
            if($this->isEditUserVaild($request)){
                $newUser = new \App\User;
                $newUser->username = $request->request->get('username');
                $newUser->email = $request->request->get('email');
                $newUser->password = Hash::make($request->request->get('password'));
                $newUser->save();
                $result = array('ok' => true, 'message' => 'User successfully changed.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => $errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isAdminGroup(Request $request){
        $username = $request->request->get('username');
        $user = \App\User::where('username', $username)->get()[0];
        $adminUsers = \App\User_Group::where('group_id', 1)->get();
        foreach($adminUsers as $AdminUser){
            if($adminUser->user_id == $user->user_id){
                return true;
            }
        }
        return false;
    }

    private function isEditUserVaild(Request $request){
        $user_id = $request->request->get('user_id');
        if($user_id != null){
            $username = $request->request->get('username');
            if($username != null){
                $email = $request->request->get('email');
                if($email != null){
                    $password = $request->request->get('password');
                    if($password != null){
                        if(isPasswordValid($password)){
                            return true;
                        } 
                    }   
                } else {
                    $errorMessage = "Email is empty.";
                }
            } else {
                $errorMessage = 'Username is empty.';
            }
        } else {
            $errorMessage = 'User ID is empty. Maybe there was an error in call transfer.';
        }
    }

    private function isAddUserVaild(Request $request){
        $username = $request->request->get('username');
        if(\App\User::where('username', $username)->get()[0] == null){
            if(isUsernameValid($username)){
                $email = $request->request->get('username');
                if(\App\User::where('email', $email)->get()[0] == null){
                    if(isEmailValid($email)){
                        $password = $request->request->get('username');
                        if($password != null ){
                            if(isPasswordValid()){
                                return true;
                            }
                        } else {
                            $errorMessage = "Password can not be empty";
                        }
                    }
                } else {
                    $errorMessage = "This email is already in use.";
                }
            }
        } else {
            $errorMessage = "This username is already taken.";
        }
        return false;
    }

    private function isPasswordValid(String $password){
        if(strlen($password) >= 8){
            if(strlen($password) <= 64){
                if (preg_match('/[%&*@#~?-]/', $password)){
                    if (preg_match('/[0123456789]/', $password)){
                        if (preg_match('/[A-Z]/', $password)){
                            return true;
                        } else {
                            $errorMessage = "Password is invalid: You have to include at least one uppercase letter.";
                        }
                    }else {
                        $errorMessage = "Password is invalid: You have to include at least one number.";
                    }
                }else {
                    $errorMessage = "Password is invalid: You have to include at least one special character ( % & * @ # ? -).";
                }
            } else {
                $errorMessage = "Password is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $errorMessage = "Password is invalid: It must have a length of at least 8 characters.";
        }
        return false;
    }

    private function isUsernameValid(String $username){
        if(strlen($username) >= 4){
            if(strlen($username) <= 64){
                return true;
            } else {
                $errorMessage = "Username is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $errorMessage = "Username is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isEmailValid(String $email){
        if(strlen($email) >= 4){
            if(strlen($username) <= 128){
                $atPos = strpos($email, '@');
                if($atPos != false){
                    $dotPos = strpos($email, '.', $atPos);
                    if($dotPos != null){
                        return true;
                    } else {
                        $errorMessage = "Email is invalid: no TLD found. Expecting '.' after '@'";
                    }
                } else {
                    $errorMessage = "Email is invalid: no domain found. Expecting '@'.";
                }
            } else {
                $errorMessage = "Email is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $errorMessage = "Email is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}