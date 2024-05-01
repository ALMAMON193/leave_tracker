<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveHistoryController extends Controller
{
    public function showLeaveHistory()
    {
        $leaveRequests = LeaveRequest::where('user_id', auth()->id())->get();
        return view('pages.Front-end.home', compact('leaveRequests'));
    }
}
