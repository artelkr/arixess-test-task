<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $feedbacks = Feedback::query()
            ->with(['user', 'manager'])
            ->oldest()
            ->get();

        return view('admin.dashboard', [
            'feedbacks' => $feedbacks
        ]);
    }
}
