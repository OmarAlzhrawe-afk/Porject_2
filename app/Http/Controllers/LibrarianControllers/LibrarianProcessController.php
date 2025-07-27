<?php

namespace App\Http\Controllers\LibrarianControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Models\Book_loan;
use App\Models\Cultural_book;
use App\Models\Student_textbook_sale;
use App\Models\Text_book;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewBookLoan;
use App\Notifications\NewBookSale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LibrarianProcessController extends Controller
{
    // CRUD Textual_Books
    public function Add_Textual_book(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'subject_id' => 'required | exists:subjects,id',
                'education_level_id' => 'required | exists:education_levels,id',
                'title' => 'required|string|max:50',
                'total_quantity' => 'required|integer|max:10000',
                'price' => 'required'
            ]);
            if ($validator->fails()) {
                return    HelpersFunctions::error("Invalid Data", 400, $validator->errors());
            }
            $exist_book = Text_book::where([
                'subject_id' => $request->input('subject_id'),
                'title' => $request->input('title'),
                'education_level_id' => $request->input('education_level_id'),
            ])->first();
            if (!empty($exist_book)) {
                return  HelpersFunctions::success("", "Book That You Want To Create It Is Exists in Our School Data Pleas Edit it Instead Of Create New One", 200);
            }
            $new_text_book = new Text_book();
            $new_text_book->subject_id = $request->input('subject_id');
            $new_text_book->education_level_id = $request->input('education_level_id');
            $new_text_book->title = $request->input('title');
            $new_text_book->total_quantity = $request->input('total_quantity');
            $new_text_book->sold_quantity = 0;
            $new_text_book->available_quantity = $request->input('total_quantity');
            $new_text_book->price = $request->input('price');
            $new_text_book->save();
            DB::commit();
            return  HelpersFunctions::success($new_text_book, "Adding Book Done", 200);
        } catch (Exception $e) {
            return     HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function edit_Textual_book(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'Book_id' => 'required|exists:text_books,id',
                'Increase_quantity' => 'required|integer|max:10000',
                'price' => 'nullable|integer'
            ]);
            if ($validator->fails()) {
                return  HelpersFunctions::error("Invalid Data", 400, $validator->errors());
            }
            $exist_book = Text_book::find($request->Book_id);
            $exist_book->total_quantity = $exist_book->total_quantity + $request->input('Increase_quantity');
            $exist_book->available_quantity = $exist_book->available_quantity + $request->input('Increase_quantity');

            if ($request->filled('price')) {
                $exist_book->price = $request->input('price');
            }
            $exist_book->save();
            DB::commit();
            return  HelpersFunctions::success($exist_book, "edit Book Done", 200);
        } catch (Exception $e) {
            return     HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_Textual_book()
    {
        try {
            $text_books = Text_book::all();
            return  HelpersFunctions::success($text_books, "Getting Book Done", 200);
        } catch (Exception $e) {
            return  HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function delete_Textual_book($id)
    {
        try {
            $text_book = Text_book::findOrfail($id);
            if ($text_book) {
                $text_book->delete();
            } else {
                return HelpersFunctions::error("Invalid Book ", 400, "Book Not Found");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // CRUD Textual_Books
    public function Add_cultural_book(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'title' => 'required |string | max:50',
                'author' => 'required |string | max:50',
                'description' => 'required|string',
                'publisher' => 'required|string|max:50',
                'publication_year' => 'required|date',
                'type' => 'required|in:Paper,electronic,audio',
                'file' => 'nullable|file|mimes:pdf,mp4,mov,avi,wmv,mkv|max:102400',
                'copies_available' => 'nullable|integer',
            ]);
            if ($validator->fails()) {
                return    HelpersFunctions::error("Invalid Data", 400, $validator->errors());
            }
            $exist_book = Cultural_book::where([
                'title' => $request->input('title'),
                'author' => $request->input('author'),
                'type' => $request->input('type'),
            ])->first();
            if (!empty($exist_book)) {
                return  HelpersFunctions::success("", "Book That You Want To Create It Is Exists in Our School Data Pleas Edit it Instead Of Create New One", 200);
            }
            $newbook = new Cultural_book();
            $newbook->title = $request->input('title');
            $newbook->author = $request->input('author');
            $newbook->description = $request->input('description');
            $newbook->publication_year = $request->input('publication_year');
            $newbook->publisher = $request->input('publisher');
            $newbook->avg_student_rating = 0;
            $newbook->avg_teacher_rating = 0;
            $newbook->total_student_reviews = 0;
            $newbook->total_teacher_reviews = 0;
            $newbook->type = $request->input('type');
            if ($request->filled('copies_available')) {
                $newbook->copies_available = $request->input('copies_available');
            }
            if ($request->hasFile('file')) {
                $file_name = time() . '_' . $request->file('file')->getClientOriginalName();
                $file = $request->file('file');
                $file->move(public_path('uploads/books'), $file_name);
                $newbook->format_url = 'uploads/books/' . $file_name;
                $newbook->copies_available = 0;
            }
            $newbook->save();
            DB::commit();
            return  HelpersFunctions::success($newbook, "Adding Book Done", 200);
        } catch (Exception $e) {
            return     HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function edit_cultural_book(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'Book_id' => 'required|exists:cultural_books,id',
                'copies_available' => 'required|integer|max:10000',
            ]);
            if ($validator->fails()) {
                return  HelpersFunctions::error("Invalid Data", 400, $validator->errors());
            }
            $exist_book = Cultural_book::where([
                'id' => $request->Book_id,
                'type' => 'Paper'
            ])->first();
            $exist_book->copies_available = $exist_book->copies_available + $request->input('copies_available');

            $exist_book->save();
            DB::commit();
            return  HelpersFunctions::success($exist_book, "edit Book Done", 200);
        } catch (Exception $e) {
            return     HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_cultural_book()
    {
        try {
            // $text_books = Cultural_book::where('type', $type)->get();
            $text_books = Cultural_book::all();
            return  HelpersFunctions::success($text_books, "Getting Book Done", 200);
        } catch (Exception $e) {
            return  HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function delete_cultural_book($id)
    {
        try {
            $text_book = Cultural_book::findOrfail($id);
            if ($text_book) {
                $text_book->delete();
            } else {
                return HelpersFunctions::error("Invalid Book ", 400, "Book Not Found");
            }
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Make_Book_Loan(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'book_id' => 'required|exists:cultural_books,id',
                'user_id' => 'required|exists:users,id',
                'type' => 'required|in:monthly,weekly'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $book_loan = new Book_loan();
            $book_loan->user_id = $request->input('user_id');
            $book_loan->book_id = $request->input('book_id');
            $book_loan->type = $request->input('type');
            $book_loan->save();
            // Send Notification For User 
            $user = User::find($book_loan->user_id);
            $returnDate = now();
            if ($book_loan->type == 'monthly') {
                $returnDate = now()->addMonth();
            }
            if ($book_loan->type == 'weekly') {
                $returnDate = now()->addWeek();
            }
            $user->notify(new NewBookLoan($returnDate));
            DB::commit();

            return HelpersFunctions::success($book_loan, "Book Loan Register Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Make_Book_Buy(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'textbook_id' => 'required|exists:text_books,id',
                'student_id' => 'required|exists:students,id',
                'quantity' => 'required|integer'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            // 'student_id', 'textbook_id', 'sale_date', 'quantity', 'total_price'
            $text_book = Text_book::find($request->input('textbook_id'));
            if ($text_book->available_quantity == 0) {
                return HelpersFunctions::success("Quantity finished", 400, "sorry you can not perform this Sale because the quantity is finished");
            }
            $book_sale = new Student_textbook_sale();
            $book_sale->student_id = $request->input('student_id');
            $book_sale->textbook_id = $request->input('textbook_id');
            $book_sale->sale_date = now()->date;
            $book_sale->quantity = $request->input('quantity');
            $book_sale->total_price = $text_book->price *  $request->input('quantity');
            $book_sale->save();
            $text_book->available_quantity = $text_book->available_quantity - $book_sale->quantity;
            $text_book->sold_quantity = $text_book->sold_quantity + $book_sale->sold_quantity;
            $text_book->save();
            // Make Transaction For Book Sale
            Transaction::create([
                'user_id' => $book_sale->student->user_id,
                'payment_method' => 'cach',
                'amount' => $book_sale->total_price,
                'type' => 'in',
                'transaction_source' => 'buy_book',
                'status' => 'paid',
                'is_installment' => false,
            ]);
            $parent_student = User::find($book_sale->student->parent_id);
            $message = "your son puy new book from shcoole with price : " . $book_sale->total_price;
            $parent_student->notify(new NewBookSale($message));
            DB::commit();
            return HelpersFunctions::success($book_sale, "Book Loan Register Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
}
