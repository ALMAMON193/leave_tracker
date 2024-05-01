<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveRequestSubmittedMail;


class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::all();
        return view('pages.Front-end.home', ['leaveRequests' => $leaveRequests]);
    }

    public function showLeaveRequestForm()
    {
        return view('pages.Front-end.leave_request');
    }

    public function submitLeaveRequest(Request $request)
    {
        // Create new leave request
        $leaveRequest = LeaveRequest::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        // Send email notification
        Mail::to(auth()->user()->email)->send(new LeaveRequestSubmittedMail($leaveRequest));

        return redirect()->route('leave.history')->with('success', 'Leave request submitted successfully.');
    }



    public function approveLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'approved']);

        // Send notification to user
        // Notification::send($leaveRequest->user, new LeaveRequestApprovedNotification($leaveRequest));

        return redirect()->back()->with('success', 'Leave request approved successfully.');
    }

    public function rejectLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->update(['status' => 'rejected']);

        //Send notification to user
        // Notification::send($leaveRequest->user, new LeaveRequestRejectedNotification($leaveRequest));

        return redirect()->back()->with('success', 'Leave request rejected successfully.');
    }
}
