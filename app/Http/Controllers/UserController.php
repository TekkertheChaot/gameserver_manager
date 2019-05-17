<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function addUser(Request $request){
        
        if($this->isCallAuthorized($request)){
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            if($username != null && $email != null && $password != null){
                if($this->isAddUserVaild($request)){
                    $newUser = new \App\User;
                    $newUser->username = $username;
                    $newUser->email = $email;
                    $newUser->password = Hash::make($password);
                    $newUser->save();
                    $result = array('ok' => true, 'message' => 'User successfully created.');
                    return json_encode($result);
                }
            } else {
                $this->$errorMessage = "Unexpected Condition: malformed request";
            }
            $result = array('ok' => false, 'message' => $this->$errorMessage);
            return json_encode($result);
        } else {
            return "Call not authorized";
        }
    }

    public function editUser(Request $request){

        if($this->isCallAuthorized($request)){
            $username = $request->request->get('username');
            $email = $request->request->get('email');
            $password = $request->request->get('password');
            if($username != null && $email != null && $password != null){
                if($this->isEditUserVaild($request)){
                    $user_id = $request->request->get('user_id');
                    $oldUser = \App\User::where('user_id', $user_id)->get()[0];
                    $oldUser->username = $request->request->get('username');
                    $oldUser->email = $request->request->get('email');
                    $oldUser->password = Hash::make($request->request->get('password'));
                    $oldUser->save();
                    $result = array('ok' => true, 'message' => 'User successfully changed.');
                    return json_encode($result);
                } 
            } else {
                $this->$errorMessage = "Unexpected Condition: malformed request";
            }
            $result = array('ok' => false, 'message' => $this->$errorMessage);
            return json_encode($result);
        } else {
            return "Call not authorized";
        }
    }

    public function deleteUser(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteUserVaild($request)){
                $user = \App\User::find($request->request->get('user_id'));
                $user->delete();
                $result = array('ok' => true, 'message' => 'User successfully deleted.');
                return json_encode($result);
                
            } else {
                $result = array('ok' => false, 'message' => $this->$errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    private function isUserInAdminGroup(Request $request){
        $user_id = $request->request->get('user_id');
        $user = \App\User::find($user_id);
        $adminUsers = \App\User_Group::where('group_id', 1)->get();
        foreach($adminUsers as $adminUser){
            if($adminUser->user_id === $user->user_id){
                return true;
            }
        }
        return false;
    }

    private function isDeleteUserVaild(Request $request){
        $user_id = $request->request->get('user_id');
        if($user_id != null){
            if(!$this->isUserInAdminGroup($request)){
                return true;
            } else {
                $this->$errorMessage = 'User is a Administrator and cannot be deleted.';
            }
        } else {
            $this->$errorMessage = 'User ID is empty. Maybe there was an error in call transfer.';
        }
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
                        if($this->isPasswordValid($password)){
                            return true;
                        } 
                    }   
                } else {
                    $this->$errorMessage = "Email is empty.";
                }
            } else {
                $this->$errorMessage = 'Username is empty.';
            }
        } else {
            $this->$errorMessage = 'User ID is empty. Maybe there was an error in call transfer.';
        }
    }

    private function isAddUserVaild(Request $request){
        $username = $request->request->get('username');
        if(\App\User::where('username', $username)->get()[0] == null){
            if($this->isUsernameValid($username)){
                $email = $request->request->get('email');
                if(\App\User::where('email', $email)->get()[0] == null){
                    if($this->isEmailValid($email)){
                        $password = $request->request->get('password');
                        if($password != null ){
                            if($this->isPasswordValid($password)){
                                return true;
                            }
                        } else {
                            $this->$errorMessage = "Password can not be empty";
                        }
                    }
                } else {
                    $this->$errorMessage = "This email is already in use.";
                }
            }
        } else {
            $this->$errorMessage = "This username is already taken.";
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
                            $this->$errorMessage = "Password is invalid: You have to include at least one uppercase letter.";
                        }
                    }else {
                        $this->$errorMessage = "Password is invalid: You have to include at least one number.";
                    }
                }else {
                    $this->$errorMessage = "Password is invalid: You have to include at least one special character ( % & * @ # ? -).";
                }
            } else {
                $this->$errorMessage = "Password is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $this->$errorMessage = "Password is invalid: It must have a length of at least 8 characters.";
        }
        return false;
    }

    private function isUsernameValid(String $username){
        if(strlen($username) >= 4){
            if(strlen($username) <= 64){
                return true;
            } else {
                $this->$errorMessage = "Username is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $this->$errorMessage = "Username is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isEmailValid(String $email){
        if(strlen($email) >= 4){
            if(strlen($email) <= 128){
                $atPos = strpos($email, '@');
                if($atPos != false){
                    $dotPos = strpos($email, '.', $atPos);
                    if($dotPos != null){
                        return true;
                    } else {
                        $this->$errorMessage = "Email is invalid: no TLD found. Expecting '.' after '@'";
                    }
                } else {
                    $this->$errorMessage = "Email is invalid: no domain found. Expecting '@': ".$email;
                }
            } else {
                $this->$errorMessage = "Email is invalid: It must have a length of 64 characters at most.";
            }
        }else {
            $this->$errorMessage = "Email is invalid: It must have a length of at least 4 characters.";
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        $user = \App\User::where('username', $username)->get()[0];
        return ($username != null && $user != null);
    }
}