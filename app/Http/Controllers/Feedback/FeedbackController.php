<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function input(Request $request)
    {
        $id = $request->id ?? null;
        /** @var Feedback $feedback */
        $feedback = Feedback::query()->find((int)$id);
        return view('feedback.input', ['feedback' => $feedback]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate(
            [
                'id' => 'integer|exist:id',
                'user_name' => 'required|string',
                'comment' => 'required|string',
            ]
        );
        if(!isset($validated['id'])) {
            $feed = new Feedback();
            $feed->user_name = $validated['user_name'];
            $feed->comment = $validated['comment'];
        } else {
            $feed = Feedback::query()->find($validated['id']);
            $feed->fill($validated);
        }
        $feed->save();

        return view('welcome')->with(['message' => "Отзыв добавлен"]);
    }

    public function list()
    {
        return view('feedback.all', ['feedbacks' => Feedback::all()]);
    }
}
