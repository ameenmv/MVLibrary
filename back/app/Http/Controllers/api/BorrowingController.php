<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Forbidden'], 403);
        }

        $borrowings = Borrowing::with(['user','book'])->get();
        return response()->json(['status' => true, 'data' => $borrowings]);
    }

    public function myBorrowings()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        $borrowings = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->get();

        return response()->json(['status' => true, 'data' => $borrowings]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'book_id'    => 'required|exists:books,id',
            'days'       => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $book = Book::find($request->book_id);

        if ($book->quantity < 1) {
            return response()->json(['status' => false, 'message' => 'Book not available'], 400);
        }


        $book->quantity = $book->quantity - 1;
        $book->save();

        $borrowedAt = Carbon::now();
        $daysToBorrow = (int) $request->input('days');
        if ($daysToBorrow < 1) {
            $daysToBorrow = 1;
        }
        $returnDate = $borrowedAt->copy()->addDays($daysToBorrow)->toDateString();

        $borrowing = Borrowing::create([
            'user_id'     => $user->id,
            'book_id'     => $book->id,
            'borrowed_at' => $borrowedAt,
            'return_date' => $returnDate,
            'status'      => 'borrowed'
        ]);

        return response()->json(['status' => true, 'data' => $borrowing], 201);
    }

    public function returnBook($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 401);
        }

        $borrowing = Borrowing::find($id);
        if (!$borrowing) {
            return response()->json(['status' => false, 'message' => 'Borrowing record not found'], 404);
        }

        if ($borrowing->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Forbidden'], 403);
        }

        if ($borrowing->status === 'returned') {
            return response()->json(['status' => false, 'message' => 'Already returned'], 400);
        }

        $borrowing->returned_at = Carbon::now();
        $borrowing->status = 'returned';
        $borrowing->save();

        $book = Book::find($borrowing->book_id);
        if ($book) {
            $book->quantity = $book->quantity + 1;
            $book->save();
        }

        return response()->json(['status' => true, 'data' => $borrowing]);


    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }
        $borrowing = Borrowing::find($id);
        if (!$borrowing) {
            return response()->json(['status' => false, 'message' => 'borrowing not found'], 404);
        }
        $borrowing->delete();
        return response()->json(['status' => true, 'message' => 'borrowing deleted successfully']);
    }
}
