<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminHome()
    {
        // Retrieve leave requests data
        $leaveRequests = LeaveRequest::all();

        // Calculate statistics
        $totalLeaveRequests = LeaveRequest::count();
        $approvedRequests = LeaveRequest::where('status', 'approved')->count();
        $rejectedRequests = LeaveRequest::where('status', 'rejected')->count();

        // Pass the data to the view
        return view('pages.Back-end.admin_dashboard', compact('leaveRequests', 'totalLeaveRequests', 'approvedRequests', 'rejectedRequests'));
    }
}
