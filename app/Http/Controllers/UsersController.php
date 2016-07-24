<?php namespace App\Http\Controllers;

use App\Http\Requests\SaveUserRequest;
use Carbon\Carbon;
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
        $user = $this->findNotExpiredUserById($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = $this->findAnyUserById($id);

        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveUserRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveUserRequest $request, $id) {
        $password = DB::selectOne("SELECT password FROM users WHERE users.id = :user_id",['user_id' => $id])->password;

        $data = [
            'id' => $id,
            'first_name' => $request->input('first_name'),
            'middle_name' => (trim($request->input('middle_name') != "")?$request->input('middle_name'):null),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => (trim($request->input('password')) != "")?bcrypt($request->input('password')):$password,
            'expires_at' => Carbon::parse($request->input('expires_at'))->toDateTimeString(),
            'role_id' => $request->input('role_id')
        ];

        DB::update("UPDATE users SET
                    users.first_name = :first_name,
                    users.middle_name = :middle_name,
                    users.last_name = :last_name,
                    users.email = :email,
                    users.password = :password,
                    users.expires_at = :expires_at,
                    users.role_id = :role_id
                    WHERE users.id = :id",$data);

        return redirect()->back()->with('message','User upated successfully');
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
     * Finds a non expired user by Id
     *
     * @param $id
     * @return mixed
     */
    private function findNotExpiredUserById($id) {
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

    /**
     * Finds any user by id
     *
     * @param $id
     * @return mixed
     */
    private function findAnyUserById($id) {
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
                                WHERE users.id = :user_id",[
            'user_id' => $id
        ]);
    }
}
