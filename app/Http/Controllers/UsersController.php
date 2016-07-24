<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = DB::select('SELECT 
                              users.id,
                              users.first_name,
                              users.middle_name,
                              users.last_name,
                              users.email,
                              users.expires_at,
                              users.role_id,
                              roles.role_name
                              FROM users
                              JOIN roles ON roles.id = users.role_id
                              WHERE expires_at > NOW()');

        return view('users.index',compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = $this->findUserById($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

    }

    /**
     * Finds a user by Id
     *
     * @param $id
     * @return mixed
     */
    private function findUserById($id) {
        return DB::selectOne("SELECT
                                users.id,
                                users.first_name,
                                users.middle_name,
                                users.last_name,
                                users.email,
                                users.created_at,
                                users.expires_at,
                                users.role_id,
                                roles.role_name
                                FROM users
                                JOIN roles ON roles.id = users.role_id
                                WHERE users.id = :user_id
                                AND expires_at > NOW()",[
           'user_id' => $id
        ]);
    }
}
