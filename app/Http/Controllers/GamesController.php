<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    private $errorMessage;

    public function testcall(Request $request)
    {
        $data = $request->all(); // This will get all the request data.
        dd($data); // This will dump and die
    }

    public function getAddGameDialog(Request $request)
    {
        return \View::make('management/games/addGame')->render();
    }
    public function getEditGameDialog(Request $request)
    {
        return \View::make('management/games/editGame')->render();
    }
    public function getDeleteGameDialog(Request $request)
    {
        return \View::make('management/games/deleteGame')->render();
    }

    public function addGame(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isAddGameVaild($request)){
                $newGame = new \App\Game;
                $newGame->game_name = $request->request->get('game_name');
                $newGame->game_label = $request->request->get('game_label');
                $newGame->support_rcon = $request->request->get('rcon');
                $newGame->save();
                $result = array('ok' => true, 'message' => 'Game successfully created.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Game could not be created: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function editGame(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isEditGameVaild($request)){
                $game_id = $request->request->get('game_id');
                $oldGame = \App\Game::where('game_id', $game_id)->first();
                $oldGame->game_name = $request->request->get('game_name');
                $oldGame->game_label = $request->request->get('game_label');
                $oldGame->support_rcon = $request->request->get('rcon');
                $oldGame->save();
                $result = array('ok' => true, 'message' => 'Game successfully changed.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Game could not be edited: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }

    public function deleteGame(Request $request){
        if($this->isCallAuthorized($request)){
            if($this->isDeleteGameVaild($request)){
                $game = \App\Game::find($request->request->get('game_id'));
                $game->delete();
                $result = array('ok' => true, 'message' => 'Game successfully deleted.');
                return json_encode($result);
            } else {
                $result = array('ok' => false, 'message' => 'Game could not be deleted: '.$this->errorMessage);
                return json_encode($result);
            }
        } else {
            return "Call not authorized";
        }
    }
    private function isDeleteGameVaild(Request $request){
        $game_id = $request->request->get('game_id');
        if($game_id != null){
            return true;
        } else {
            $this->errorMessage = 'Game ID could not be fetched.';
        }
    }

    private function isEditGameVaild(Request $request){
        $game_name = $request->request->get('game_name');
        $game_label = $request->request->get('game_label');
        $game_id = $request->request->get('game_id');
        if($game_id != null){
            if($game_name != null){
                if($game_label!= null){
                    if(!preg_match('/\s/',$game_label)){
                        return true;
                    } else {
                        $this->errorMessage = "The game label must not contain whitespaces.";
                    }
                } else {
                    $this->errorMessage = "The game label must not be empty.";
                }
            } else {
                $this->errorMessage = 'Game name is empty.';
            }
        } else {
            $this->errorMessage = 'Game ID could not be fetched.';
        }
    }

    private function isAddGameVaild(Request $request){
        $game_name = $request->request->get('game_name');
        $game_label = $request->request->get('game_label');
        if($game_name != null){
            if($game_label!= null){
                if(!preg_match('/\s/',$game_label)){
                    return true;
                } else {
                    $this->errorMessage = "The game label must not contain whitespaces.";
                }
            } else {
                $this->errorMessage = "The game label must not be empty.";
            }
        } else {
            $this->errorMessage = "The game name must not be empty.";
        }
        return false;
    }

    private function isCallAuthorized(Request $request){
        $username = $request->request->get('loggedUsername');
        return ($username != null && \App\User::where('username', $username)->get()[0] != null);
    }
}