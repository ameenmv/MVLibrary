<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();
        return response()->json(['status' => true, 'data' => $books]);
    }

    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Book not found'], 404);
        }
        return response()->json(['status' => true, 'data' => $book]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }
        if ($user->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Only admin can perform this action'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:100',
            'quantity'    => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        $book = Book::create([
            'title'       => $request->title,
            'author'      => $request->author,
            'description' => $request->description,
            'category'    => $request->category,
            'quantity'    => $request->quantity,
            'cover_image' => $coverImagePath,
        ]);

        return response()->json(['status' => true, 'data' => $book], 201);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }
        if ($user->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Only admin can perform this action'], 403);
        }

        $book = Book::find($id);
        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Book not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'       => 'sometimes|string|max:255',
            'author'      => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'sometimes|string|max:100',
            'quantity'    => 'sometimes|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('cover_image')) {

            if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $book->cover_image = $request->file('cover_image')->store('covers', 'public');
        }

        $book->fill($request->except('cover_image'))->save();

        return response()->json(['status' => true, 'data' => $book]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated'], 401);
        }
        if ($user->role !== 'admin') {
            return response()->json(['status' => false, 'message' => 'Only admin can perform this action'], 403);
        }

        $book = Book::find($id);
        if (!$book) {
            return response()->json(['status' => false, 'message' => 'Book not found'], 404);
        }

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();
        return response()->json(['status' => true, 'message' => 'Book deleted successfully']);
    }
}
