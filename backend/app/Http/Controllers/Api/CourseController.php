<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\{Course, FinalizedCourse, User};
use App\Repositories\{NotificationRepository};
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Course index
     * 
     * @param none
     * @return Course $courses
     */
    public function index() {
        return Course::get(['id', 'name', 'author', 'description']);
    }

    /**
     * Show a specific Course
     * 
     * @param none
     * @return Course $courses
     */
    public function show($course_id, Request $request) {
        // Obtain course
        $course = Course::find($course_id);

        // If requested course doesn't exists
        if (!$course) {
            return response()->json(['message' => 'Course not found'], 404);
        }

        // Verify if user has watched course
        $user = User::whereAccessToken($request->header('x-access-token'))
                    ->first(['id']);

        $watched = FinalizedCourse::whereUserId($user->id)
                                ->whereCourseId($course->id)
                                ->first();


        // Create response
        $response = [
                        'course' => $course, 
                        'watched' => ($watched) ? true : false
                    ];

        return response($response);
    }

    /**
     * Set a Course as a completed
     * 
     * @param Request $request
     * @return Response $response
     */
    public function courseCompleted(Request $request) {
        // Obtain user data
        $user = User::whereAccessToken($request->header('x-access-token'))
                    ->first(['id', 'organization_id']);

        // Set course as completed
        $finalized_course = new FinalizedCourse;
        $finalized_course->user_id = $user->id;
        $finalized_course->course_id = $request->course_id;
        $finalized_course->save();

        // Create notification
        $event = 'Course ' . $request->course_id . ' completed';
        $notification_repository = new NotificationRepository;
        $notification_repository->createNotification($user->id, $user->organization_id, $event);
        
        return response()->json(['message' => 'Course succesfully completed'], 201);
    }
}
