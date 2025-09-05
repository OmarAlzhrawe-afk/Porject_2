<?php

namespace App\Http\Controllers\StudentControllers;

use App\Helpers\HelpersFunctions;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Class_room;
use App\Models\Class_session;
use App\Models\Cultural_book;
use App\Models\Education_content;
use App\Models\Education_level;
use App\Models\Home_work;
use App\Models\Homeworksolving;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Traits\SharedFunctionTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    use SharedFunctionTrait;

    public function getProfile()
    {
        try {
            $user = auth('sanctum')->user();
            $profile_data = Student::where('user_id', $user->id)
                ->with(['user', 'profile'])
                ->first();
            $profile_data = [
                'student_number'   => $profile_data->Student_number,
                'status'           => $profile_data->status,
                'className'        =>  $profile_data->class->name,
                'name'             => $profile_data->user->name,
                'email'            => $profile_data->user->email,
                //'role'             => $profile_data->user->role,
                'phone_number'     => $profile_data->user->phone_number,
                'birth_date'       => $profile_data->user->birth_date,
                'gender'           => $profile_data->user->gender,
                'address'          => $profile_data->user->address,
                'score'                => $profile_data->profile->score ?? null,
                'behavior_notes'       => $profile_data->profile->behavior_notes ?? null,
                'health_notes'         => $profile_data->profile->health_notes ?? null,
                'interests'            => $profile_data->profile->interests ?? null,
                'activities_participated' => $profile_data->profile->activities_participated ?? null,
                'achievements'         => $profile_data->profile->achievements ?? null,
                //'guardian_feedback'    => $profile_data->profile->guardian_feedback,
                'teacher_feedback'     => $profile_data->profile->teacher_feedback ?? null,
                'skills'               => $profile_data->profile->skills ?? null,
                'total_absences'       => $profile_data->profile->total_absences ?? null,
                'unexcused_absences'   => $profile_data->profile->unexcused_absences ?? null,
            ];
            return HelpersFunctions::success($profile_data, "Getting profile_data Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function getSchedule()
    {
        try {
            $user =  User::find(auth('sanctum')->user()->id);
            $sessions = Class_session::where('class_room_id', $user->student->class->id)
                ->orderBy('session_day')
                ->get()->map(function ($session) {
                    return [
                        'class_Name' => $session->class->name,
                        'subject' => $session->teacher->subject->name,
                        'Teacher_name' => $session->teacher->user->name,
                        'start_time' => $session->start_time,
                        'end_time' => $session->end_time,
                    ];
                })
                ->groupBy('day');
            // $user = auth('sanctum')->user();
            // $sessions = $user->student->sessions;
            return HelpersFunctions::success($sessions, "Getting schedule Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function contents()
    {
        try {
            $user = auth('sanctum')->user();
            $contents = Education_content::where('class_room_id', $user->student->class->id)
                ->get()
                ->map(function ($content) {
                    return [
                        'teacher_name' => User::find($content->teacher_id)?->name,
                        'class_name' => Class_room::find($content->class_id)?->name,
                        'title' => $content->title,
                        'description' => $content->description,
                        'content_type' => $content->content_type,
                        'file_url' =>  url($content->file_url),
                        'created_at' => $content->created_at->format('Y-m-d H:i')
                    ];
                });
            return HelpersFunctions::success($contents, "Getting schedule Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_text_books()
    {
        try {
            $user = auth('sanctum')->user();
            $education_level = Education_level::find($user->student->class->education_level_id);
            $books = $education_level->books->map(function ($book) {
                return [
                    'subject_name' => Subject::find($book->id)?->name,
                    'title' => $book->name,
                    'price' => $book->price,
                    'available_quantity' => $book->price,
                ];
            });
            return HelpersFunctions::success($books, "Getting schedule Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function getCulturalBooks()
    {
        try {
            $books = Cultural_book::all()->groupBy('type')->map(function ($items, $type) {
                return $items->map(function ($book) use ($type) {
                    $data = [
                        'id'          => $book->id,
                        'title'       => $book->title,
                        'author'      => $book->author,
                        'publisher'   => $book->publisher,
                        'year'        => $book->publication_year,
                        // 'copies'      => $book->copies_available,
                        'description' => $book->description,
                    ];
                    if ($type === 'paper') {
                        $data['copies'] = $book->copies_available;
                    }
                    if (in_array($type, ['pdf', 'audio'])) {
                        $data['format_url'] = $book->format_url ? url($book->format_url) : null;
                    }

                    return $data;
                });
            });

            return HelpersFunctions::success($books, "Getting Cultural books successfully.");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error at line " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function get_activities()
    {
        try {
            $user = auth('sanctum')->user();
            $classRoomId = $user->student->class->id;
            $educationLevelId = $user->student->class->education_level->id;
            $activities = Activity::where('term_id', HelpersFunctions::getCurrentTermId())
                ->where('registration_deadline', '>=', now())
                ->where(function ($query) use ($classRoomId, $educationLevelId) {
                    $query->where('class_room_id', $classRoomId)
                        ->orWhere('education_level_id', $educationLevelId);
                })
                ->get()->map(function ($activity) {
                    return [
                        'id' => $activity->id,
                        'Title' => $activity->Title,
                        'Description' => $activity->Description,
                        'activity_type' => $activity->activity_type,
                        'date' => $activity->date,
                        'location' => $activity->location,
                        'target_group' => $activity->target_group,
                        'is_paid' => $activity->is_paid,
                        'cost' => $activity->cost,
                        'seats_limit' => $activity->seats_limit,
                        'registration_deadline' => $activity->registration_deadline,
                        'gallery_urls' => collect($activity->gallery_urls)->map(function ($path) {
                            return url($path);
                        }),
                        'required_skills' => $activity->required_skills,
                    ];
                });
            return HelpersFunctions::success($activities, "Getting schedule Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }


    public function register_in_activity(Request $request)
    {
        return  $this->register_in_activity_for_all($request);
    }
    public function get_daily_homwork()
    {
        try {
            $user = auth('sanctum')->user();
            $studentId = $user->student->id;
            $classRoomId = $user->student->class->id;
            $homeworks = Home_work::with(['teacher.user', 'class', 'solvings'])
                ->where('class_id', $classRoomId)
                ->where('last_date', '>=', now())
                ->get()
                ->map(function ($homework) use ($studentId) {
                    return [
                        'teacher'     => $homework->teacher->user->name ?? 'null',
                        'class'       => $homework->class->name ?? 'null',
                        'description' => $homework->description,
                        'homework_url' => $homework->file ? url('uploads/homeworks/' . $homework->file) : null,
                        'last_date'   => $homework->last_date,
                        'solved'      => $homework->solvings->where('student_id', $studentId)->isNotEmpty(),
                    ];
                });

            return HelpersFunctions::success($homeworks, "Getting Home_Work Done");
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    public function solve_homwork(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'homework_id' => 'required|exists:home_works,id',
            'solve_url' => 'required|file|mimes:pdf,svg,png,jpg',
        ]);
        if ($validator->fails()) {
            return HelpersFunctions::error("Bad Request ", 400, $validator->errors());
        }
        try {
            $user = auth('sanctum')->user();
            $studentId = $user->student->id;
            $alreadySolved = Homeworksolving::where('homework_id', $request->homework_id)
                ->where('student_id', $studentId)
                ->exists();
            if ($alreadySolved) {
                return HelpersFunctions::error("Logical Error", 400, "You have already solved this homework.");
            }
            $homeworks_solve = new Homeworksolving();
            $homeworks_solve->homework_id = $request->homework_id;
            $homeworks_solve->student_id = $user->student->id;
            $homeworks_solve->solved = true;
            if ($request->hasFile('solve_url')) {
                $file = $request->file('solve_url');
                $file_Name = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/Homwork/solving'), $file_Name);
                $homeworks_solve->solve_url = 'uploads/Homwork/solving' . $file_Name;
            }
            $homeworks_solve->save();
            // save activity
            activity()->causedBy(auth('sanctum')->user())->withProperties([
                'Process_type' => "Solve HomeWork",
            ])->log("Student "  . auth('sanctum')->user()->name  . "Solve HomeWork");
            return HelpersFunctions::success(null, "adding solve Done", 200);
        } catch (Exception $e) {
            return HelpersFunctions::error("Internal Server Error IN : " . $e->getLine(), 500, $e->getMessage());
        }
    }
    //  Notifications
    public function notificationss()
    {
        return $this->notifications();
    }
    public function markAsReads($id)
    {
        return $this->markAsRead($id);
    }






    // public function sendEmail(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     // التحقق من وجود الطالب في جدول التسجيل المسبق بحالة 'accepted'
    //     $profile = Pre_Registration::where('student_email', $request->email)
    //         ->where('status', 'accepted')
    //         ->first();

    //     if (!$profile) {
    //         return response()->json(['message' => 'الطالب غير مقبول أو غير موجود'], 403);
    //     }

    //     // البحث عن كود تحقق موجود لهذا الايميل
    //     $existingCode = Login_Code::where('email', $request->email)->latest()->first();

    //     if ($existingCode) {
    //         // تحقق هل الكود لم ينتهي (الصلاحية لم تنتهي)
    //         if ($existingCode->expires_at && now()->lessThanOrEqualTo($existingCode->expires_at)) {
    //             // الكود لا يزال صالحاً، لا ترسل كود جديد، ارجع رسالة مع توضيح
    //             return response()->json([
    //                 'message' => ' الانتظار حتى انتهاء صلاحية الكود.'
    //             ], 429); // 429 Too Many Requests أو رمز مناسب لك
    //         }
    //     }

    //     $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    //     // حفظ أو تحديث كود التحقق مع وقت انتهاء الصلاحية (30 ثانية من الآن)
    //     Login_Code::updateOrCreate(
    //         ['email' => $request->email],
    //         [
    //             'code' => $code,
    //             'expires_at' => now()->addSeconds(80),
    //         ]
    //     );

    //     // إرسال الكود عبر البريد
    //     Mail::raw("كود التحقق الخاص بك هو: $code", function ($message) use ($request) {
    //         $message->to($request->email)
    //             ->subject('كود التحقق للطالب');
    //     });

    //     return response()->json(['message' => 'تم إرسال كود التحقق إلى بريدك الإلكتروني.']);
    // }


    // public function loginWithCode(Request $request)
    // {
    //     // تحقق من صحة المدخلات
    //     $request->validate([
    //         'code' => 'required|string',
    //     ]);

    //     // جلب آخر كود مطابق
    //     $loginCode = Login_code::where('code', $request->code)
    //         ->latest()
    //         ->first();

    //     if (!$loginCode) {
    //         return response()->json(['message' => 'كود غير صالح أو منتهي'], 401);
    //     }

    //     // تحقق من انتهاء صلاحية الكود
    //     if (!$loginCode->expires_at || Carbon::now()->gt(Carbon::parse($loginCode->expires_at))) {
    //         return response()->json(['message' => 'كود غير صالح أو منتهي'], 401);
    //     }

    //     $email = $loginCode->email;

    //     // ابحث عن الطالب بناءً على البريد
    //     $pre = Pre_registration::where('student_email', $email)->first();

    //     if (!$pre) {
    //         return response()->json(['message' => 'لا يوجد تسجيل مبدئي لهذا البريد'], 404);
    //     }

    //     // الآن نبحث عن الطالب الفعلي في جدول students:
    //     $student = Student::where('email', $email)->first();

    //     if (!$student) {
    //         return response()->json(['message' => 'لا يوجد طالب مرتبط بهذا البريد'], 404);
    //     }
    //     $token = $student->createToken('student_token')->plainTextToken;
    //     return response()->json([
    //         'message' => 'تم تسجيل بنجاح',
    //         'token' => $token,
    //     ], 200);
    // }


    // public function getProfile()
    // {
    //     $student = Auth::guard('student')->user();

    //     $profile = Student_profile::with('educationLevel')->where('student_id', $student->id)->first();
    //     $classRoom = $student->classRoom;

    //     // أفضل مادة
    //     $bestMark = $student->marks()
    //         ->with('subject') // ✅ تحميل المادة مباشرة
    //         ->orderByDesc('score')
    //         ->first();

    //     $bestScience = optional($bestMark->subject)->name; // ✅ استخدام العلاقة الجديدة


    //     $totalAbsences = $profile->total_absences ?? 0;
    //     $unexcusedAbsences = $profile->unexcused_absences ?? 0;

    //     $attendancePercentage = 100;
    //     if ($totalAbsences > 0) {
    //         $attendancePercentage = 100 - (($unexcusedAbsences / $totalAbsences) * 100);
    //     }

    //     // نسبة المشاركة
    //     $participations = Activity_participants::where('student_id', $student->id)->get();
    //     $totalParticipations = $participations->count();
    //     $attendedCount = $participations->where('attendance', 1)->count();

    //     $effectiveParticipation = $totalParticipations > 0
    //         ? round(($attendedCount / $totalParticipations) * 100) . '%'
    //         : '0%';

    //     // النشاط الأكثر حضوراً
    //     $topActivity = $participations
    //         ->where('attendance', 1)
    //         ->groupBy('activity_id')
    //         ->map(fn($group) => $group->count())
    //         ->sortDesc()
    //         ->keys()
    //         ->first();

    //     $topActivityTitle = null;
    //     if ($topActivity) {
    //         $activity = Activity::find($topActivity);
    //         $topActivityTitle = $activity ? $activity->Title : null;
    //     }

    //     $subjectsCount = 0;
    //     $totalHomeworks = 0;
    //     $completed = 0;

    //     if ($classRoom) {



    //         $subjectIds = \App\Models\Class_session::where('class_room_id', $student->class_room_id)
    //             ->whereNotNull('subject_id')
    //             ->distinct()
    //             ->pluck('subject_id');

    //         $subjectsCount = $subjectIds->count();




    //         $homeworkContents = Education_content::where('class_room_id', $classRoom->id)
    //             ->where('content_type', 'duty')
    //             ->get();

    //         $totalHomeworks = $homeworkContents->count();
    //         $homeworkIds = $homeworkContents->pluck('id')->toArray();

    //         $completed = HomeworkSubmission::where('student_id', $student->id)
    //             ->whereIn('homework_id', $homeworkIds)
    //             ->distinct('homework_id')
    //             ->count('homework_id');
    //     }

    //     return response()->json([
    //         'student_id' => $student->id,
    //         'student_name'             => $student->student_name,
    //         'email'                    => $student->email,
    //         'phone '                   => $profile?->phone,
    //         'Avarge '                   => $profile?->score,
    //         'address '                 => $profile?->address,
    //         'attendance_percentage' => number_format($attendancePercentage) . '%',
    //         'JoiningDate' => now()->format('Y-m-d'),

    //         'achievements_count'  =>    is_array(json_decode($profile->achievements, true))
    //             ? count(json_decode($profile->achievements, true))
    //             : 0,
    //         'BestScience'              => $bestScience,
    //         'education_level' => $profile->educationLevel?->name . '  ' . $classRoom->name,
    //         'TopActivityTitle'         => $topActivityTitle,
    //         'SubjectsCount'            => $subjectsCount,
    //         'completed_homework'       => "{$completed}/{$totalHomeworks}",
    //     ]);
    // }



    // public function getSchedule(Request $request)
    // {
    //     $student = auth('student')->user();

    //     if (!$student || !$student->class_room_id) {
    //         return response()->json(['message' => 'الطالب غير مرتبط بأي صف دراسي'], 404);
    //     }

    //     $classSessions = \App\Models\Class_session::with(['teacher', 'classRoom', 'subject'])
    //         ->where('class_room_id', $student->class_room_id)
    //         ->get()
    //         ->groupBy('session_day');

    //     $schedule = [];

    //     foreach ($classSessions as $day => $sessions) {
    //         $schedule[$day] = $sessions->map(function ($session) {
    //             $start = \Carbon\Carbon::parse($session->start_time);
    //             $end = \Carbon\Carbon::parse($session->end_time);
    //             $duration = $start->diffInMinutes($end); // احسب المدة بالدقائق

    //             return [
    //                 'Teacher'       => $session->teacher->name ?? 'غير معروف',
    //                 'Class'         => $session->classRoom->name ?? 'غير معروف',
    //                 'subject'       => $session->subject->name ?? 'مادة غير محددة',
    //                 'StartTime'  => $start->format('H:i'),
    //                 'period' => $duration,
    //             ];
    //         });
    //     }

    //     return response()->json([
    //         'الجدول الدراسي' => $schedule,
    //     ]);
    // }


    // public function studentBooks(Request $request)
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير مسجل الدخول'], 401);
    //     }

    //     $classRoom = $student->classRoom;

    //     if (!$classRoom || !$classRoom->education_level_id) {
    //         return response()->json(['message' => 'لا يوجد صف مرتبط بالطالب أو الصف غير مرتبط بمستوى تعليمي'], 404);
    //     }

    //     $educationLevelId = $classRoom->education_level_id;

    //     // جلب المواد المرتبطة بهذا المستوى
    //     $subjects = Subject::with(['textBooks' => function ($query) use ($educationLevelId) {
    //         $query->where('education_level_id', $educationLevelId);
    //     }])->get();

    //     $data = $subjects->map(function ($subject) {
    //         $books = $subject->textBooks->map(function ($book) {
    //             return [
    //                 'book_name' => $book->title,
    //                 'status' => $book->available_quantity > 0 ? 'متاح' : 'مستعار بالكامل',
    //                 'available_quantity' => $book->available_quantity,
    //                 'total_quantity' => $book->total_quantity,
    //                 'price' => $book->price,
    //             ];
    //         });

    //         return [
    //             'subject_name' => $subject->name,
    //             'books' => $books,
    //         ];
    //     });

    //     return response()->json([
    //         //            'student_name' => $student->student_name,
    //         'schedule_books' => $data
    //     ]);
    // }
    // public function studentBooksBySubject(Request $request)
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير مسجل الدخول'], 401);
    //     }

    //     $classRoom = $student->classRoom;

    //     if (!$classRoom || !$classRoom->education_level_id) {
    //         return response()->json(['message' => 'لا يوجد صف مرتبط بالطالب أو الصف غير مرتبط بمستوى تعليمي'], 404);
    //     }

    //     $educationLevelId = $classRoom->education_level_id;
    //     $subjectName = $request->input('subject_name');

    //     if (!$subjectName) {
    //         return response()->json(['message' => 'يرجى إدخال اسم المادة'], 400);
    //     }

    //     $subject = Subject::where('name', 'LIKE', "%{$subjectName}%")
    //         ->with(['textBooks' => function ($query) use ($educationLevelId) {
    //             $query->where('education_level_id', $educationLevelId);
    //         }])
    //         ->first();

    //     if (!$subject) {
    //         return response()->json(['message' => 'المادة غير موجودة أو لا تحتوي على كتب لهذا المستوى'], 404);
    //     }

    //     $books = $subject->textBooks->map(function ($book) {
    //         return [
    //             'book_name' => $book->title,
    //             'status' => $book->available_quantity > 0 ? 'متاح' : 'مستعار بالكامل',
    //             'available_quantity' => $book->available_quantity,
    //             'total_quantity' => $book->total_quantity,
    //             'price' => $book->price,
    //         ];
    //     });

    //     return response()->json([

    //         'subject_name' => $subject->name,
    //         'books' => $books
    //     ]);
    // }

    // public function studentBooksByTitle(Request $request)
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير مسجل الدخول'], 401);
    //     }

    //     $classRoom = $student->classRoom;

    //     if (!$classRoom || !$classRoom->education_level_id) {
    //         return response()->json(['message' => 'لا يوجد صف مرتبط بالطالب أو الصف غير مرتبط بمستوى تعليمي'], 404);
    //     }

    //     $educationLevelId = $classRoom->education_level_id;
    //     $bookTitle = $request->input('book_title');

    //     if (!$bookTitle) {
    //         return response()->json(['message' => 'يرجى إدخال اسم الكتاب'], 400);
    //     }

    //     $books = Text_book::where('title', 'LIKE', "%{$bookTitle}%")
    //         ->where('education_level_id', $educationLevelId)
    //         ->with('subject')
    //         ->get();

    //     if ($books->isEmpty()) {
    //         return response()->json(['message' => 'لا يوجد كتب بهذا الاسم ضمن مستواك التعليمي'], 404);
    //     }

    //     $result = $books->map(function ($book) {
    //         return [
    //             'book_name' => $book->title,
    //             'subject' => $book->subject ? $book->subject->name : 'غير معروف',
    //             'status' => $book->available_quantity > 0 ? 'متاح' : 'مستعار بالكامل',
    //             'available_quantity' => $book->available_quantity,
    //             'total_quantity' => $book->total_quantity,
    //             'price' => $book->price,
    //         ];
    //     });

    //     return response()->json([

    //         'books' => $result
    //     ]);
    // }


    // public function index()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student || !$student->class_room_id) {
    //         return response()->json(['message' => 'الطالب غير مرتبط بصف دراسي'], 404);
    //     }

    //     $contents = Education_content::with('subject') // تحميل المادة لتفادي N+1
    //         ->where('class_room_id', $student->class_room_id)
    //         ->get();

    //     return response()->json([
    //         'class_room_id' => $student->class_room_id,
    //         'contents' => $contents->map(function ($item) {
    //             // إعداد البيانات الإضافية بناءً على نوع المحتوى
    //             $extraData = match ($item->content_type) {
    //                 'video' => ['duration' => $item->video_duration],
    //                 'pdf'   => ['pages' => $item->pdf_pages],
    //                 'quiz'  => [
    //                     'questions_count' => $item->quiz_questions_count,
    //                     'due' => $this->formatDueDate($item->due_date),
    //                 ],
    //                 'duty'  => [
    //                     'questions_count' => $item->quiz_questions_count,
    //                     'grade' => $item->quiz_questions_count,
    //                     'due' => $this->formatDueDate($item->due_date),
    //                 ],
    //                 default => []
    //             };

    //             return array_merge([
    //                 'id' => $item->id,
    //                 'title' => $item->title,
    //                 'description' => $item->description,
    //                 'type' => $item->content_type,
    //                 'file_url' => $item->file_url,
    //                 'subject' => $item->subject?->name,
    //             ], $extraData);
    //         }),
    //     ]);
    // }


    // private function formatDueDate($date)
    // {
    //     if (!$date) {
    //         return 'تاريخ غير محدد';
    //     }

    //     $now = Carbon::now()->startOfDay();
    //     $taskDate = Carbon::parse($date)->startOfDay();
    //     $diff = $now->diffInDays($taskDate, false);

    //     return match (true) {
    //         $diff === 0 => 'اليوم التسليم',
    //         $diff === 1 => 'غدًا التسليم',
    //         $diff > 1 => 'بعد ' . $diff . ' أيام',
    //         default => 'انتهى وقت التسليم'
    //     };
    // }

    // public function submit(Request $request)
    // {
    //     $request->validate([
    //         'homework_id' => 'required|exists:education_contents,id',
    //         'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,zip|max:10240', // 10MB
    //         'notes' => 'nullable|string',
    //     ]);

    //     $student = Auth::guard('student')->user();

    //     // التحقق أن الواجب فعلاً نوعه duty
    //     $homework = Education_content::where('id', $request->homework_id)
    //         ->where('content_type', 'duty')
    //         ->first();

    //     if (!$homework) {
    //         return response()->json(['message' => 'الواجب غير موجود أو ليس من نوع duty'], 404);
    //     }

    //     // حفظ الملف
    //     $filePath = $request->file('file')->store('homework_submissions', 'public');

    //     // إنشاء التسليم
    //     $submission = HomeworkSubmission::create([
    //         'student_id' => $student->id,
    //         'homework_id' => $homework->id,
    //         'file_url' => $filePath,
    //         'notes' => $request->notes,
    //         'submitted_at' => now(),
    //     ]);



    //     return response()->json([
    //         'message' => 'تم تسليم الواجب بنجاح',
    //         'submission' => [
    //             'student_id' => $submission->student_id,
    //             'homework_id' => $submission->homework_id,
    //             'file_url' => $submission->file_url,
    //             'notes' => $submission->notes,
    //             'submitted_at' => $submission->submitted_at->format('Y-m-d'), // فقط التاريخ
    //         ],
    //     ]);
    // }


    // public function getMyMarks()
    // {
    //     $student = Auth::guard('student')->user();

    //     $student->load('marks.teacher.subject', 'profile');

    //     $marks = $student->marks->map(function ($mark) {
    //         return [
    //             'subject'       => optional($mark->teacher->subject)->name,
    //             'teacher_name'  => $mark->teacher->name,
    //             'exam_type'     => $mark->exam_type,
    //             'score'         => $mark->score,
    //             'max_score'     => $mark->max_score,
    //             'date'          => $mark->date,
    //             'teacher_note'  => $mark->teacher_note,
    //         ];
    //     });

    //     // حساب المعدل
    //     $average = $student->marks->avg('score');

    //     // حفظه في student_profiles
    //     if ($student->profile) {
    //         $student->profile->score = $average;
    //         $student->profile->save();
    //     }

    //     return response()->json([
    //         'marks'   => $marks,
    //         'average' => round($average, 2)
    //     ]);
    // }





    // public function getPurchasedBooks()
    // {
    //     $studentUser = Auth::guard('student')->user();

    //     $studentUser->load('textbookSales.textbook');

    //     $purchasedBooks = $studentUser->textbookSales->map(function ($sale) {
    //         return [
    //             'title' => $sale->textbook->title,
    //             'quantity' => $sale->quantity,
    //             'total_price' => $sale->total_price,
    //             'sale_date' => $sale->sale_date,
    //         ];
    //     });

    //     return response()->json([
    //         //            'student' => $studentUser->student_name,
    //         'purchased_books' => $purchasedBooks,
    //     ]);
    // }
    // public function getBorrowedBooks()
    // {
    //     $studentUser = Auth::guard('student')->user();

    //     $studentUser->load('bookLoans.culturalBook');

    //     $borrowedBooks = $studentUser->bookLoans->map(function ($loan) {
    //         return [
    //             'title' => $loan->culturalBook->title,
    //             'author' => $loan->culturalBook->author,
    //             'loaned_on' => $loan->created_at->toDateString(),
    //         ];
    //     });

    //     return response()->json([

    //         'borrowed_books' => $borrowedBooks,
    //     ]);
    // }
    // public function getProfileu()
    // {
    //     $student = Auth::guard('student')->user();

    //     // تحقق من وجود الصف وملف الطالب
    //     $classRoom = $student->classRoom;
    //     $profile = $student->Student_profile;

    //     if (!$classRoom) {
    //         return response()->json([
    //             'message' => 'لا يوجد صف مرتبط بالطالب.',
    //             'homeworks' => "0/0",
    //             'average_score' => null,
    //             'achievement_count' => 0,
    //             'attendance_percentage' => "0.00%"
    //         ], 200);
    //     }

    //     // المحتوى التعليمي للصف
    //     $contents = Education_content::where('class_room_id', $classRoom->id)->get();
    //     $homeworkContents = $contents->where('content_type', 'duty');
    //     $totalHomeworks = $homeworkContents->count();

    //     // الواجبات المسلمة
    //     $submittedHomeworkIds = HomeworkSubmission::where('student_id', $student->id)
    //         ->pluck('homework_id')
    //         ->toArray();

    //     $completed = $homeworkContents->filter(fn($c) => in_array($c->id, $submittedHomeworkIds))->count();
    //     $incomplete = $totalHomeworks - $completed;

    //     // حساب النسبة المئوية للحضور
    //     $totalAbsences = $profile->total_absences ?? 0;
    //     $unexcusedAbsences = $profile->unexcused_absences ?? 0;

    //     $attendancePercentage = 100;
    //     if ($totalAbsences > 0) {
    //         $attendancePercentage = 100 - (($unexcusedAbsences / $totalAbsences) * 100);
    //     }

    //     return response()->json([
    //         'homeworks' => "{$completed}/{$incomplete}",
    //         'average_score' => $profile->score ?? null,
    //         'achievement_count' => is_array(json_decode($profile->achievements, true))
    //             ? count(json_decode($profile->achievements, true))
    //             : 0,
    //         'attendance_percentage' => number_format($attendancePercentage) . '%',
    //     ]);
    // }

    // public function upcomingTasks()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student || !$student->class_room_id) {
    //         return response()->json(['message' => 'الطالب غير مرتبط بصف دراسي'], 404);
    //     }

    //     $quizzes = Education_content::with('subject')
    //         ->where('class_room_id', $student->class_room_id)
    //         ->where('content_type', 'quiz')
    //         ->get();

    //     $homeworks = Education_content::with('subject')
    //         ->where('class_room_id', $student->class_room_id)
    //         ->where('content_type', 'duty')
    //         ->get();

    //     $allTasks = $quizzes->concat($homeworks);

    //     // ترتيب وتصنيف الوقت
    //     $tasks = $allTasks->map(function ($item) {
    //         $now = Carbon::now()->startOfDay();
    //         $taskDate = $item->due_date ? Carbon::parse($item->due_date)->startOfDay() : null;

    //         if (!$taskDate) {
    //             $due = 'تاريخ غير محدد';
    //         } else {
    //             $diff = $now->diffInDays($taskDate, false); // الفرق مع الاتجاه

    //             if ($diff === 0) {
    //                 $due = 'اليوم التسليم';
    //             } elseif ($diff === 1) {
    //                 $due = 'غدًا التسليم';
    //             } elseif ($diff > 1) {
    //                 $due = 'بعد ' . $diff . ' أيام';
    //             } else {
    //                 $due = 'انتهى وقت التسليم';
    //             }
    //         }

    //         return [
    //             'title' => $item->title,
    //             'subject' => $item->subject?->name,
    //             'due' => $due,

    //         ];
    //     });

    //     // ترتيب حسب التاريخ (ثم حذف حقل _sort_date)
    //     $sortedTasks = $tasks->sortBy('_sort_date')->map(function ($task) {
    //         unset($task['_sort_date']);
    //         return $task;
    //     })->values(); // إعادة الفهارس

    //     return response()->json([
    //         'upcoming_tasks' => $sortedTasks,
    //     ]);
    // }


    // public function submittedHomeworksAndActivities()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير موجود'], 404);
    //     }

    //     // 1. الواجبات التي تم تسليمها
    //     $submittedHomeworks = \App\Models\HomeworkSubmission::with('homework')
    //         ->where('student_id', $student->id)
    //         ->get()
    //         ->map(function ($submission) {
    //             $submittedAt = $submission->created_at;
    //             return [
    //                 'title' => $submission->homework->title ?? 'بدون عنوان',
    //                 'type' => 'homework',
    //                 'time' => $submittedAt ? Carbon::parse($submittedAt)->diffForHumans() : 'غير معروف',
    //                 'grade' => $submission->garde ?? 'لم يتم التصحيح',
    //             ];
    //         });


    //     return response()->json([
    //         'submitted_homeworks' => $submittedHomeworks,

    //     ]);
    // }
    // public function getAbsenceSummary()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student || !$student->Student_profile) {
    //         return response()->json(['message' => 'لا توجد بيانات حضور لهذا الطالب.'], 404);
    //     }

    //     $profile = $student->Student_profile;

    //     $totalAbsences = $profile->total_absences ?? 0;
    //     $unexcusedAbsences = $profile->unexcused_absences ?? 0;
    //     $excusedAbsences = $totalAbsences - $unexcusedAbsences;

    //     return response()->json([
    //         'total_absences' => $totalAbsences,
    //         'unexcused_absences' => $unexcusedAbsences,
    //         'excused_absences' => $excusedAbsences,
    //     ]);
    // }
    // public function getAchievements()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student || !$student->Student_profile) {
    //         return response()->json(['message' => 'لم يتم العثور على بيانات الطالب.'], 404);
    //     }

    //     $profile = $student->Student_profile;

    //     $achievements = json_decode($profile->achievements, true);

    //     if (!is_array($achievements)) {
    //         $achievements = [];
    //     }

    //     return response()->json([
    //         'achievements' => $achievements
    //     ]);
    // }

    // public function indexEduction(Request $request)
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student || !$student->class_room_id) {
    //         return response()->json(['message' => 'الطالب غير مرتبط بصف دراسي'], 404);
    //     }

    //     $type = $request->query('type'); // جلب نوع المحتوى من الرابط

    //     // تحقق إذا تم تمرير النوع وكان صالحًا
    //     if ($type && !in_array($type, ['video', 'pdf', 'quiz'])) {
    //         return response()->json(['message' => 'نوع المحتوى غير صالح'], 400);
    //     }

    //     $query = Education_content::with('subject')->where('class_room_id', $student->class_room_id);

    //     if ($type) {
    //         $query->where('content_type', $type);
    //     }

    //     $contents = $query->get();

    //     return response()->json([
    //         //            'class_room_id' => $student->class_room_id,
    //         'type' => $type ?? 'all',
    //         'contents' => $contents->map(function ($item) {
    //             return [
    //                 'title' => $item->title,
    //                 //                  'due_date'  =>$this->formatDueDate($item->due_date),
    //                 'description' => $item->description,
    //                 'type' => $item->content_type,
    //                 'file_url' => $item->file_url,
    //                 'subject' => $item->subject?->name,
    //             ];
    //         }),
    //     ]);
    // }

    // public function getStudentSubjects()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير موجود'], 404);
    //     }

    //     $classRoomId = $student->class_room_id;

    //     // جلب المواد من جدول الحصص
    //     $subjects = \App\Models\Subject::whereIn('id', function ($query) use ($classRoomId) {
    //         $query->select('subject_id')
    //             ->from('class_sessions')
    //             ->where('class_room_id', $classRoomId);
    //     })->get(['id', 'name']);

    //     return response()->json([
    //         'class' => $student->classRoom->name ?? 'غير معروف',
    //         'subjects' => $subjects
    //     ]);
    // }
    // public function studentSubjectsWithTeacher()
    // {
    //     $student = Auth::guard('student')->user();

    //     if (!$student) {
    //         return response()->json(['message' => 'الطالب غير موجود'], 404);
    //     }

    //     $classRoomId = $student->class_room_id;

    //     // جلب الحصص مع المعلم والمادة
    //     $sessions = \App\Models\Class_session::with(['subject', 'teacher'])
    //         ->where('class_room_id', $classRoomId)
    //         ->get();

    //     // تنظيم البيانات لتكون كل مادة مرة واحدة فقط
    //     $subjects = $sessions->unique('subject_id')->map(function ($session) {
    //         return [
    //             'subject_name' => $session->subject->name ?? 'غير معروف',
    //             'teacher_name' => $session->teacher->name ?? 'غير معروف',
    //         ];
    //     })->values();

    //     return response()->json([
    //         'class' => $student->classRoom->name ?? 'غير معروف',
    //         'subjects' => $subjects
    //     ]);
    // }



    // public function getSubjectCountForStudent($studentId)
    // {
    //     // جلب الصف الخاص بالطالب
    //     $student = Student::findOrFail($studentId);
    //     $classRoomId = $student->class_room_id;

    //     // حساب عدد المواد المختلفة المرتبطة بهذا الصف من جدول class_sessions
    //     $subjectCount = DB::table('class_sessions')
    //         ->where('class_room_id', $classRoomId)
    //         ->distinct('subject_id')
    //         ->count('subject_id');

    //     return response()->json([
    //         'student_id' => $studentId,
    //         'class_room_id' => $classRoomId,
    //         'subject_count' => $subjectCount
    //     ]);
    // }
    // public function getSubjectsForClass($classId)
    // {
    //     $subjectIds = Class_session::where('class_room_id', $classId)
    //         ->whereNotNull('subject_id')
    //         ->distinct()
    //         ->pluck('subject_id');

    //     $subjects = Subject::whereIn('id', $subjectIds)->get();

    //     return $subjects;
    // }
}
