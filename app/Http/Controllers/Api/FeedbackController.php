<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Requests\Api\FeedbackRequest;
class FeedbackController extends Controller
{
    public function create(FeedbackRequest $request)
    {
        $user = $this->user();
        $feedback = Feedback::create([
            'user_id' => $user->id,
            'feedback_content' => $request->feedback_content,
            'phone' => $request->phone,
        ]);

        return $feedback;
    }
}
