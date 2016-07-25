@extends('layouts.app')

@section('content')
    @if(session('fine'))
        <div class="modal fade" id="fine-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Receive Fine</h4>
                    </div>
                    <div class="modal-body">
                        <p>You should receive Rs. {{ session('fine') }} as fine for the latest transaction.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script>
            window.onload =function() {
                $("#fine-modal").modal();
            };
        </script>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="text--center">Issue a book copy</h3>

                <div>
                    <p>
                        <strong>Book Title: </strong> {{ $bookCopy->book_name }}
                    </p>
                    <p>
                        <strong>ISBN: </strong> {{ $bookCopy->isbn }}
                    </p>
                    <p>
                        <strong>Edition: </strong> {{ $bookCopy->edition }}
                    </p>
                    <p>
                        <strong>Publication: </strong> {{ $bookCopy->publication_name }}
                    </p>
                    <p>
                        <strong>Category: </strong> {{ $bookCopy->category_name }}
                    </p>
                    <p>
                        <strong>Copy ID: </strong> {{ $bookCopy->copy_id }}
                    </p>
                    <p>
                        <strong>Status: </strong> {{ ($bookCopy->is_issued == 0)?"Available":"Issued" }}
                    </p>
                </div>

                @include('partials.messagebag')

                <form action="{{ route('books.copies.issue',['books' => $bookCopy->id,'copies' => $bookCopy->copy_id]) }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('member_id') ? ' has-error' : '' }}">
                        <div class="col-md-6 form-inline">
                            @if($bookCopy->is_issued == 0)
                                <label for="member-id" class="control-label">Member: </label>
                                <select id="member-id" class="form-control chosen-select" name="member_id">
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">
                                            {{ $member->first_name.' '.$member->middle_name.' '.$member->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('member_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member_id') }}</strong>
                                    </span>
                                @endif

                                <button type="submit" class="btn btn-primary">
                                    Issue Book Copy to the user
                                </button>
                            @else
                                <input type="hidden" name="parent_id" value="{{ $transactions->first()->id }}">
                                <input type="hidden" name="member_id" value="{{ $transactions->first()->member_id }}">
                                <button type="submit" class="btn btn-primary">
                                    Renew Book
                                </button>
                            @endif
                        </div>
                    </div>
                </form>

                @if($bookCopy->is_issued == 1)
                    <form method="post" action="{{ route('books.copies.issue.return',['books' => $bookCopy->id,'copies' => $bookCopy->copy_id,'issues' => $transactions->first()->id]) }}">
                        {{ csrf_field() }}

                        <button type="submit" class="btn btn-primary">
                            Return Copy
                        </button>
                    </form>
                @endif

                <br>
                <br>

                <div class="col-md-12">
                    @if(count($transactions))
                        <div class="table-responsive">
                            <table class="table table-stripped transactions-table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>Member Name</th>
                                    <th>Librarian Name</th>
                                    <th>Issued At</th>
                                    <th>Deadline At</th>
                                    <th>Issue status</th>
                                    <th>Fine</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="{{ ($transaction->parent_id == null)?'transactions-table__row--new-issue':'transactions-table__row--renewed-issue' }}">
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->book_name }}</td>
                                        <td>{{ $transaction->member_fname.' '.$transaction->member_mname.' '.$transaction->member_lname }}</td>
                                        <td>{{ $transaction->librarian_fname.' '.$transaction->librarian_mname.' '.$transaction->librarian_lname }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->issued_at)->diffForHumans() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->deadline_at)->diffForHumans() }}</td>
                                        <td>{{ ($transaction->parent_id == null)?"First Issue":"Renew" }}</td>
                                        <td>Rs. {{ ($transaction->fine_amt)?:"0.0" }}</td>
                                        <td>{{ ($transaction->is_completed == 1)?"Completed":"Not Completed" }}<br />
                                            <small>
                                                {{ ($transaction->is_completed == 1)?\Carbon\Carbon::parse($transaction->completed_at)->diffForHumans():"" }}
                                            </small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <br>
                        <br>
                        <h4 class="text--center">
                            There are no transactions for this book copy.
                        </h4>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection