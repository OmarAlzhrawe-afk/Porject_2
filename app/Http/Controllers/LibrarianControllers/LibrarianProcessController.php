<?php

namespace App\Http\Controllers\LibrarianControllers;

use App\Events\BookAdded;
use App\Events\BookDelete;
use App\Events\BookSaleEvent;
use App\Events\BookUpdate;
use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Models\Book_loan;
use App\Models\Cultural_book;
use App\Models\Qr_Code;
use App\Models\Staff_attendance;
use App\Models\Staff_leaves;
use App\Models\Student;
use App\Models\Student_textbook_sale;
use App\Models\Text_book;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\LeaveOrderNotification;
use App\Notifications\NewBookLoan;
use App\Notifications\NewBookSale;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF as NewPDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use App\Exports\LibraryExport;
use App\Exports\LibrarySalesLoansExport;
use App\Models\Education_level;
use App\Models\Report;
use App\Models\Subject;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\SharedFunctionTrait;
use Dompdf\Helpers;

use function PHPUnit\Framework\isEmpty;

class LibrarianProcessController extends Controller
{
    use SharedFunctionTrait;
    public function leave_demand(Request $request)
    {
        return  $this->leave_demand_for_all($request);
    }
    public function get_last_activity()
    {
        return $this->get_last_activity_for_all();
    }
    public function surfing_salary()
    {
        return  $this->surfing_salary_for_all();
    }
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
                return  HelpersFunctions::success(null, "Book That You Want To Create It Is Exists in Our School Data Pleas Edit it Instead Of Create New One", 200);
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
            event(new BookAdded($new_text_book, "textual"));
            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Adding Textual Book",
                'date' => now()->format('Y-m-d'),
            ])->log("Adding Textual Book");
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
            event(new BookUpdate($exist_book, "textual"));
            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Editing Textual Book",
                'date' => now()->format('Y-m-d'),
            ])->log("Editing Textual Book");

            return  HelpersFunctions::success(null, "edit Book Done", 200);
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
            $text_book = Text_book::find($id);
            if ($text_book) {
                $text_book->delete();
                event(new BookDelete($text_book->id, "textual"));
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "deleting Textual Book",
                    'date' => now()->format('Y-m-d'),
                ])->log("deleting Textual Book");
                return HelpersFunctions::success(null, "Deleting Done", 200);
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
                'title' => 'required|string|max:50',
                'author' => 'required|string|max:50',
                'description' => 'required|string',
                'publisher' => 'required|string|max:50',
                'publication_year' => 'required|digits:4|integer|min:1500|max:' . date('Y'),
                'type' => 'required|in:paper,pdf,audio',
                'file' => 'nullable|file|mimes:pdf,mp4,mp3,mov,avi,wmv,mkv|max:102400',
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
                return  HelpersFunctions::success(null, "Book That You Want To Create It Is Exists in Our School Data Pleas Edit it Instead Of Create New One", 200);
            }
            $newbook = new Cultural_book();
            $newbook->title = $request->input('title');
            $newbook->author = $request->input('author');
            $newbook->description = $request->input('description');
            $newbook->publication_year = $request->input('publication_year') . '-01-01';
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
            event(new BookAdded($newbook, "cultural"));
            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Adding Cultural Book",
                'date' => now()->format('Y-m-d'),
            ])->log("Adding Cultural");

            return  HelpersFunctions::success(null, "Adding Book Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
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
            if (empty($exist_book)) {
                return  HelpersFunctions::success(null, "the Book That You Want to edit Is Not Found Or Not Paper Format", 200);
            }
            $exist_book->copies_available = $exist_book->copies_available + $request->input('copies_available');
            $exist_book->save();
            event(new BookUpdate($exist_book, "cultural"));
            DB::commit();

            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Editing Cultural Book",
                'date' => now()->format('Y-m-d'),
            ])->log("Editing Cultural Book");

            return  HelpersFunctions::success(null, "edit Book Done", 200);
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
                event(new BookDelete($text_book->id, "cultural"));
                $user = auth('sanctum')->user();
                activity()->causedBy($user)->withProperties([
                    'Process_type' => "deleting Cultural Book",
                    'date' => now()->format('Y-m-d'),
                ])->log("deleting Cultural Book");
                return HelpersFunctions::success(null, "Deleting Cultural Book Done", 200);
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
                'user_id' => 'required|exists:students,Student_number',
                'type' => 'required|in:monthly,weekly'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $student = Student::where('Student_number', $request->user_id)->first();
            $user = User::find($student->user_id);

            // Validate If Student Have Been Loan This Book In Last And Dont Return It Yet ]
            $last_loan = Book_loan::where([
                'user_id' => $user->id,
                'cultural_book_id' => $request->input('book_id'),
            ])->first();
            if ($last_loan != null) {
                return HelpersFunctions::success(null, "You Have Been Loan This Book And Dont Return It yet", 200);
            }
            $book_loan = new Book_loan();
            if (!$student) {
                return HelpersFunctions::error("Bad Request", 400, "Student not found");
            }
            $book_loan->user_id = $user->id;
            $book_loan->cultural_book_id = $request->input('book_id');
            $book_loan->type = $request->input('type');
            $book_loan->status = "unreturned";
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
            // Update Cultural Book 
            $book = Cultural_book::find($request->book_id);
            $book->copies_available = $book->copies_available--;
            $book->save();
            event(new BookUpdate($book, "cultural"));
            DB::commit();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Making Book Loan",
                'date' => now()->format('Y-m-d'),
            ])->log("Making Book Loan");
            return HelpersFunctions::success(null, "Book Loan Register Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Make_Book_Buy(Request $request)
    {

        try {
            DB::beginTransaction();
            // Validate Data
            $validator = Validator::make($request->all(), [
                'textbook_id' => 'required|exists:text_books,id',
                'student_id' => 'required|exists:students,Student_number',
                'quantity' => 'required|integer'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            // Fetch Book & Validate It  
            $text_book = Text_book::find($request->input('textbook_id'));
            if ($text_book->available_quantity == 0) {
                return HelpersFunctions::success("Quantity Finished", 400, "sorry you can not perform this Sale because the quantity is finished");
            }

            // create &  save sales book data and Book update data and send Events with data
            $book_sale = new Student_textbook_sale();
            $student = Student::where('Student_number', $request->student_id)->first();

            $book_sale->student_id = $student->id;
            $book_sale->textbook_id = $request->input('textbook_id');
            $book_sale->sale_date = now();
            $book_sale->quantity = $request->input('quantity');
            $book_sale->total_price = $text_book->price *  $request->input('quantity');
            $book_sale->save();
            event(new BookSaleEvent($book_sale));
            $text_book->available_quantity = $text_book->available_quantity - $book_sale->quantity;
            $text_book->sold_quantity = $text_book->sold_quantity + $book_sale->quantity;
            $text_book->save();
            // Send Event with Book updated 
            event(new BookUpdate($text_book, "textual"));
            // Make Transaction For Book Sale
            Transaction::create([
                'user_id' => $book_sale->student->user_id,
                'payment_method' => 'cash',
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
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Making Book Buy",
                'date' => now()->format('Y-m-d'),
            ])->log("Making Book Buy");

            return HelpersFunctions::success(null, "Book Buy Done ", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function Verify_Qr_Code(Request $request)
    {
        return $this->verifyQrCodeRequest($request, 'employee');
    }
    public function get_students()
    {
        try {
            $students = Student::with('user')->get()->map(function ($student) {
                return [
                    'id' => $student->id,
                    'class_id' => $student->class_id,
                    'user' => [
                        'id' => $student->user->id,
                        'name' => $student->user->name,
                        'email' => $student->user->email,
                        'phone_number' => $student->user->phone_number,
                    ],
                ];
            });
            return HelpersFunctions::success($students, 'Getting Students Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_loans()
    {
        try {
            $loans = Book_loan::with(['user', 'book_loan'])->get()->map(function ($loan) {
                return [
                    'id' => $loan->id,
                    'type' => $loan->type,
                    'status' => $loan->status,
                    'user_data' => [
                        'id' => $loan->user->id,
                        'name' => $loan->user->name,
                        'role' => $loan->user->role,
                    ],
                    'book_data' => [
                        'id' =>   $loan->book_loan->id,
                        'title' => $loan->book_loan->title,
                        'author' => $loan->book_loan->author,
                        'type' => $loan->book_loan->type,
                    ]
                ];
            });
            return HelpersFunctions::success($loans, 'Getting Loans Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_sales()
    {
        try {
            $sales = Student_textbook_sale::with(['student', 'book'])->get()->map(function ($sale) {
                return [
                    'id' =>   $sale->id,
                    'sale_date' => $sale->sale_date,
                    'quantity' =>   $sale->quantity,
                    'total_price' =>   $sale->total_price,
                    'user_data' => [
                        'id' =>   $sale->student->user->id,
                        'name' => $sale->student->user->name,
                        'Student_number' => $sale->student->Student_number,
                    ],
                    'book_data' => [
                        'id' =>     $sale->book->id,
                        'title' =>  $sale->book->title,
                        'price' => $sale->book->price,
                    ]
                ];
            });
            return HelpersFunctions::success($sales, 'Getting Loans Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function return_book(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'book_id' => 'required|exists:cultural_books,id',
                'user_id' => 'required|exists:students,Student_number',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, "Wrong User Or Book I dont Have Loan For This ");
            }
            $book = Cultural_book::find($request->book_id);
            if ($book->type != "paper") {
                return HelpersFunctions::error("Bad Book", 400, "The Book You Are Entered Is not In Paper Formating");
            }
            $student = Student::where('Student_number', $request->user_id)->first();
            $loan = Book_loan::where([
                'user_id' => $student->user_id,
                'cultural_book_id' => $request->book_id,
            ])->first();
            if ($loan) {
                $loan->status = 'returned';
                $loan->save();
                // update book cultural data  and send Event with updating data
                $cultural_book = Cultural_book::find($request->book_id);
                $cultural_book->copies_available = $cultural_book->copies_available + 1;
                $cultural_book->save();
            } else {
                return HelpersFunctions::error("Bad Loan", 400, "The Loan You Are Entered Is not Found");
            }
            // Broad Cast Real Time Event    
            event(new BookUpdate($cultural_book, "cultural"));
            // Assign Activity
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Making Book Return",
                'date' => now()->format('Y-m-d'),
            ])->log("Making Book Return");

            return HelpersFunctions::success(null, 'Returning Book Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    //  Here We Maybe edit fetch user ****
    public function get_loans_Sales_For_student(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:students,Student_number'
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $student = Student::where('Student_number', $request->user_id)->first();
            $user = User::find($student->user_id);
            // dd($user);
            // $student = null;
            $sales   = collect();
            if ($user->role == 'student') {
                // $student = Student::where('user_id', $user->id)->first();
                // dd($student);
                $sales = Student_textbook_sale::where([
                    'student_id' => $student->id,
                ])->get();
            }
            $loans = Book_loan::where([
                'user_id' => $user->id,
            ])->get();
            $all_data = [
                'user_name' => $user->name,
                'student_number'  => $student?->Student_number,
                'loans' => $loans,
                'sales' =>  $sales, // optional($sales),
            ];
            return HelpersFunctions::success($all_data, 'Getting Loans Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error In " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function make_leave_demand(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'leave_date' => 'required|date',
                'period' => 'required|in:day,3day,week,2week,month,year',
                'leave_type' => 'required|in:sick,ersonal,unpaid,emergency',
                'notes' => 'nullable|string|max:1024',
            ]);
            if ($validator->fails()) {
                return HelpersFunctions::error("Bad Request", 400, $validator->errors());
            }
            $user = auth('sanctum')->user();
            $staff_leaves = new Staff_leaves();
            $staff_leaves->user_id = $user->id;
            $staff_leaves->leave_date = $request->leave_date;
            $staff_leaves->period = $request->period;
            $staff_leaves->leave_type = $request->leave_type;
            $staff_leaves->notes = $request->notes;
            $staff_leaves->save();
            $admin = User::where('role', 'admin')->first();
            $admin->notify(new LeaveOrderNotification($user, $staff_leaves));
            return HelpersFunctions::success("", 'Getting Loans Done', 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    public function get_monthly_report()
    {
        try {
            $reports = Report::where('report_type', 'library')
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy(function ($report) {
                    return Carbon::parse($report->report_date)->format('Y-m');
                });

            $formatted = $reports->map(function ($items, $month) {
                return [
                    'month' => $month,
                    'reports' => $items->map(function ($report) {
                        return [
                            'id' => $report->id,
                            'url' => url($report->report_url),
                            'description' => $report->report_description,
                            'report_type' => $report->report_type
                        ];
                    })->values()
                ];
            })->values();
            $user = auth('sanctum')->user();
            activity()->causedBy($user)->withProperties([
                'Process_type' => "Getting Library Report",
                'date' => now()->format('Y-m-d'),
            ])->log("Getting Library Report");
            return HelpersFunctions::success($formatted, "Getting Reports Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error", 500, $e->getMessage());
        }
    }
    // Extra Apis 
    public function get_subjects_and_education_level()
    {
        try {
            $subjects = Subject::all();
            $educationlevels = Education_level::all();
            $data = [
                'education_levels' => $educationlevels,
                'subjects' => $subjects,
            ];
            return HelpersFunctions::success($data, " Getting Subjects Done ", 200);
        } catch (Exception $e) {
            return  HelpersFunctions::error("Internal Server Error ", 500, $e->getMessage());
        }
    }
    public function get_users()
    {
        try {
            $users = User::where(
                [
                    'role' => ['student', 'teacher']
                ]
            )->get()
                ->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'Name' => $user->name,
                    ];
                });
            $data = [
                'users' => $users,
            ];
            return HelpersFunctions::success($data, " Getting Users Done ", 200);
        } catch (Exception $e) {
            return  HelpersFunctions::error("Internal Users Error ", 500, $e->getMessage());
        }
    }
}
