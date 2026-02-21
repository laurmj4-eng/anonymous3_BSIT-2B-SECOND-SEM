<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\TeacherModel;
use App\Models\ParentsModel;
use App\Models\StaffModel;

// Extend BaseController instead of the core Controller
class Dashboard extends BaseController
{
    public function index()
    {
        // Load all the models
        $studentModel = new StudentModel();
        $teacherModel = new TeacherModel();
        $parentsModel = new ParentsModel();
        $staffModel   = new StaffModel();

        // 1. Cleaned up counts (CI4 automatically ignores soft-deleted rows!)
        $data = [
            'total_students' => $studentModel->countAllResults(),
            'total_teachers' => $teacherModel->countAllResults(),
            'total_parents'  => $parentsModel->countAllResults(),
            'total_staff'    => $staffModel->countAllResults(),
            
            // 2. BONUS: Grab the 5 most recently added students for a "Recent Activity" feed
            'recent_students' => $studentModel->orderBy('created_at', 'DESC')->findAll(5)
        ];

        // Pass the data to the dashboard view
        return view('dashboard', $data);
    }
}