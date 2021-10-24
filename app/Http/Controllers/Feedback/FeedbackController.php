<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function input(Request $request)
    {
        return view('feedback.input');
    }

    public function edit(Feedback $feedback)
    {
        return view('feedback.edit', ['feedback' => $feedback]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate(
            [
                'id' => 'integer|exists:feedbacks,id',
                'user_name' => 'required|string',
                'comment' => 'required|string',
            ]
        );
        $text = '';
        if(!isset($validated['id'])) {
            $feed = new Feedback();
            $text = 'добавлен';
        } else {
            $feed = Feedback::find($validated['id']);
            $text = 'изменён';
        }
        $feed->user_name = $validated['user_name'];
        $feed->comment = $validated['comment'];
        $feed->save();

        return redirect(action([__CLASS__, 'list'], ['feedbacks' => Feedback::all()]))
            ->with(['message' => "Отзыв от {$feed->user_name} {$text}"]);
    }

    public function list()
    {
        return view('feedback.all', ['feedbacks' => Feedback::paginate(3)]);
    }

    public function show(Feedback $feedback)
    {
        return view('feedback.one', ['feedback' => $feedback]);
    }

    public function destroy(Feedback $feedback)
    {
        $name = $feedback->user_name;
        $feedback->delete();

        return redirect(action([__CLASS__, 'list'], ['feedbacks' => Feedback::paginate(3)]))
            ->with(['message' => "Отзыв от <strong>$name</strong> удалён"]);
    }
}
