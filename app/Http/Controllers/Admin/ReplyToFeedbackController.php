<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ReplyToFeedback;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ReplyToFeedbackController extends Controller
{
    private ReplyToFeedback $replyToFeedbackAction;

    public function __construct(ReplyToFeedback $replyToFeedbackAction)
    {
        $this->replyToFeedbackAction = $replyToFeedbackAction;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Feedback $feedback)
    {
        $this->replyToFeedbackAction->exec($feedback->id);

        $request->session()->flash(
            'status',
            ['type' => 'sucess', 'text' => "You're replied to {$feedback->user->name} feedback!"]
        );

        return \back();
    }
}
