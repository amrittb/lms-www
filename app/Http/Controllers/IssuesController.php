<?php namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IssueBookCopyRequest;

class IssuesController extends Controller {

    /**
     * Fine amount per day
     */
    const FINE_PER_DAY = 1;

    /**
     * Book issue day limit
     */
    const BOOK_ISSUE_DAY_LIMIT = 15;

    /**
     * Show form to issue a book
     *
     * @param $bookId
     * @param $copyId
     * @return mixed
     */
    public function create($bookId,$copyId) {
        $bookCopy = $this->getBookCopy($bookId, $copyId);

        $transactions = $this->getTransactions($bookId, $copyId);

        $members = $this->getMembers();

        return view('books.issues.create',compact('bookCopy','members','transactions'));
    }

    /**
     * Issues a book copy to a user
     *
     * @param $bookId
     * @param $copyId
     * @param IssueBookCopyRequest $request
     * @return mixed
     */
    public function issue($bookId, $copyId, IssueBookCopyRequest $request) {
        $input = $this->resolveInput($bookId, $copyId, $request);

        $fine = 0;

        if($request->input('parent_id')){
            $fine = $this->generateFine($input['parent_id']);
        }

        $this->createTransaction($input);

        $this->updateBookCopyForIssue($bookId, $copyId,true);

        return $this->responseWithFine('Book issued successfully',$fine);
    }

    /**
     * Returns a book
     *
     * @param $bookId
     * @param $copyId
     * @param $transactionId
     * @return mixed
     */
    public function returnBook($bookId,$copyId,$transactionId) {
        $fine = $this->generateFine($transactionId);

        $this->markTransactionComplete($transactionId);

        $this->updateBookCopyForIssue($bookId,$copyId,false);

        return $this->responseWithFine('Book returned successfully',$fine);
    }

    /**
     * Returns a book copy
     *
     * @param $bookId
     * @param $copyId
     * @return mixed
     */
    protected function getBookCopy($bookId, $copyId) {
        return DB::selectOne("SELECT books.id,
                                      books.book_name,
                                      books.isbn,
                                      books.edition,
                                      books.publication_id,
                                      publications.publication_name,
                                      books.category_id,
                                      book_categories.category_name,
                                      book_copies.copy_id,
                                      book_copies.is_issued
                                FROM book_copies
                                JOIN books ON books.id = book_copies.book_id
                                JOIN publications ON publications.id = books.publication_id
                                JOIN book_categories ON book_categories.id = books.category_id
                                WHERE book_copies.book_id = :book_id 
                                AND book_copies.copy_id = :copy_id", [
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]);
    }

    /**
     * Return transactions for the given book and its copy
     * @param $bookId
     * @param $copyId
     * @return mixed
     */
    protected function getTransactions($bookId, $copyId) {
        return collect(DB::select("SELECT transactions.id,
                                                    transactions.member_id,
                                                    members.first_name as member_fname,
                                                    members.middle_name as member_mname,
                                                    members.last_name as member_lname,
                                                    transactions.librarian_id,
                                                    librarians.first_name as librarian_fname,
                                                    librarians.middle_name as librarian_mname,
                                                    librarians.last_name as librarian_lname,
                                                    transactions.book_id,
                                                    books.book_name,
                                                    transactions.copy_id,
                                                    transactions.issued_at,
                                                    transactions.deadline_at,
                                                    transactions.completed_at,
                                                    transactions.is_completed,
                                                    transactions.parent_id,
                                                    fines.fine_amt
                                            FROM transactions
                                            JOIN books ON books.id = transactions.book_id
                                            LEFT JOIN fines ON fines.transaction_id = transactions.id
                                            JOIN users as members ON members.id = transactions.member_id
                                            JOIN users as librarians ON librarians.id = transactions.librarian_id
                                            WHERE transactions.book_id = :book_id
                                            AND transactions.copy_id = :copy_id
                                            ORDER BY issued_at DESC", [
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]));
    }

    /**
     * Returns member users
     *
     * @return mixed
     */
    protected function getMembers() {
        return collect(DB::select("SELECT users.id,
                                    users.first_name,
                                    users.middle_name,
                                    users.last_name
                                FROM users
                                JOIN roles ON roles.id = users.role_id
                                WHERE roles.role_name = 'Member'"));
    }

    /**
     * Resolves transaction input from the request
     *
     * @param $bookId
     * @param $copyId
     * @param IssueBookCopyRequest $request
     * @return array
     */
    protected function resolveInput($bookId, $copyId, IssueBookCopyRequest $request) {
        return [
            'member_id' => $request->input('member_id'),
            'librarian_id' => \Auth::user()->id,
            'book_id' => $bookId,
            'copy_id' => $copyId,
            'issued_at' => Carbon::now()->toDateTimeString(),
            'deadline_at' => Carbon::now()->addDays(self::BOOK_ISSUE_DAY_LIMIT)->toDateTimeString(),
            'completed_at' => null,
            'is_completed' => 0,
            'parent_id' => $request->input('parent_id') ?: null
        ];
    }

    /**
     * Generates fine for given transaction
     *
     * @param $transactionId
     * @return int
     */
    protected function generateFine($transactionId) {
        $deadlineAt = $this->findTransactionById($transactionId)->deadline_at;

        return $this->calculateFine($transactionId, Carbon::parse($deadlineAt));
    }

    /**
     * Finds a transaction by id
     *
     * @param $transactionId
     * @return mixed
     */
    protected function findTransactionById($transactionId) {
        return DB::selectOne("SELECT deadline_at FROM transactions WHERE transactions.id = :transaction_id", [
            'transaction_id' => $transactionId
        ]);
    }

    /**
     * Creates a fine entry
     *
     * @param $transactionId
     * @param Carbon $deadlineAt
     * @return int
     */
    protected function calculateFine($transactionId, Carbon $deadlineAt) {
        $days = $deadlineAt->diffInDays(Carbon::now(),false);

        if($days > 0){
            $fine = self::FINE_PER_DAY * $days;

            DB::insert("INSERT INTO fines VALUES(NULL,:fine_amt,:transaction_id)",[
                'fine_amt' => $fine,
                'transaction_id' => $transactionId
            ]);

            return $fine;
        }

        return 0;
    }

    /**
     * Creates a transaction record
     *
     * @param $input
     */
    protected function createTransaction($input) {
        DB::insert("INSERT INTO transactions VALUES(
              NULL,
              :member_id,
              :librarian_id,
              :book_id,
              :copy_id,
              :issued_at,
              :deadline_at,
              :completed_at,
              :is_completed,
              :parent_id
        )", $input);
    }

    /**
     * Marks transaction complete
     *
     * @param $transactionId
     */
    protected function markTransactionComplete($transactionId) {
        DB::update("UPDATE transactions 
                    SET transactions.is_completed = 1,
                    transactions.completed_at = :completed_at
                    WHERE transactions.id = :transaction_id", [
            'completed_at' => Carbon::now()->toDateTimeString(),
            'transaction_id' => intval($transactionId)
        ]);
    }

    /**
     * Updates book copy for issue
     *
     * @param $bookId
     * @param $copyId
     * @param $isIssued
     */
    protected function updateBookCopyForIssue($bookId, $copyId,$isIssued) {
        DB::update("UPDATE book_copies SET book_copies.is_issued = ".intval($isIssued)." WHERE book_copies.book_id = :book_id AND book_copies.copy_id = :copy_id", [
            'book_id' => $bookId,
            'copy_id' => $copyId
        ]);
    }

    /**
     * Returns a response
     *
     * @param $message
     * @param $fine
     * @return mixed
     */
    protected function responseWithFine($message, $fine) {
        $response = redirect()->back()->with('message', $message);

        if ($fine > 0) {
            return $response->with('fine', $fine);
        }

        return $response;
    }
}
