<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SaveBookProviderRequest;

class BookProvidersController extends Controller {

    /**
     * Shows a list of book providers
     *
     * @return mixed
     */
    public function index() {
        $bookProviders = DB::select("SELECT book_providers.id,
                                            book_providers.provider_name,
                                            book_providers.contact_no,
                                            book_providers.contact_pname
                                    FROM book_providers");

        return view('books.providers.index',compact('bookProviders'));
    }

    /**
     * Stores a book provider entry
     *
     * @param SaveBookProviderRequest $request
     */
    public function store(SaveBookProviderRequest $request) {
        DB::insert("INSERT INTO book_providers VALUES(NULL,:provider_name,:contact_no,:contact_pname)",[
            'provider_name' => $request->input('provider_name'),
            'contact_no' => $request->input('contact_no'),
            'contact_pname' => $request->input('contact_pname')
        ]);

        return redirect()->back()->with('message','Book Provider created successfully');
    }

    /**
     * Shows book provider edit form
     *
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        $provider = DB::selectOne("SELECT id,
                                          provider_name,
                                          contact_no,
                                          contact_pname 
                                    FROM book_providers 
                                    WHERE id = :id",compact('id'));

        return view('books.providers.edit',compact('provider'));
    }

    /**
     * Updates a book provider entry
     *
     * @param $id
     * @param SaveBookProviderRequest $request
     * @return mixed
     */
    public function update($id,SaveBookProviderRequest $request) {
        DB::update("UPDATE book_providers SET 
                    provider_name = :provider_name,
                    contact_no = :contact_no,
                    contact_pname = :contact_pname 
                    WHERE id = :id",[
            'provider_name' => $request->input('provider_name'),
            'contact_no' => $request->input('contact_no'),
            'contact_pname' => $request->input('contact_pname'),
            'id' => $id
        ]);

        return redirect()->back()->with('message','Book Provider updated successfully');
    }

    /**
     * Destroys a book provider entry
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id) {
        DB::delete("DELETE FROM book_providers WHERE book_providers.id = :provider_id",[
            'provider_id' => $id
        ]);

        return redirect()->back()->with('message','Book Provider deleted successfully');
    }
}
