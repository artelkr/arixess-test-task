<?php

namespace App\Http\Controllers;

use App\Actions\AddFeedback;
use App\Exceptions\FeedbackSaveException;
use App\Http\Requests\FeedbackSaveRequest;
use Illuminate\Http\Request;

class AddFeedbackController extends Controller
{
    private AddFeedback $addFeedbackAction;

    public function __construct(AddFeedback $addFeedbackAction)
    {
        $this->addFeedbackAction = $addFeedbackAction;
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(FeedbackSaveRequest $request)
    {
        $data = $request->validated();
        /** @var \Illuminate\Http\UploadedFile|null $file */
        $file = $data['file'] ?? null;

        try {
            $this->addFeedbackAction->exec([
                'subject' => (string) $data['subject'],
                'message' => (string) $data['message'],
                'file' => $file,
            ]);

            $request->session()->flash(
                'status',
                ['type' => 'sucess', 'text' => 'Your feedback successfully saved!']
            );

            return \redirect(route('home'));
        } catch (FeedbackSaveException $e) {
            $request->session()->flash(
                'status',
                ['type' => 'error', 'text' => $e->getMessage()]
            );

            return \back()->withInput();
        }
    }
}
