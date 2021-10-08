<?php

namespace App\Actions;

use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

final class ReplyToFeedback
{
    public function exec(int $feedbackId)
    {
        /** @var Feedback */
        $feedback = Feedback::findOrFail($feedbackId);

        if ($feedback->manager) {
            /* TODO: already replied */

            return;
        }

        /** @var \App\Models\User */
        $user = Auth::guard('web')->user();

        $feedback->manager()->associate($user);
        $feedback->viewed_at = $feedback->freshTimestamp();
        $feedback->saveOrFail();
    }
}
