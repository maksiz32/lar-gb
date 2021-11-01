<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function input()
    {
        return view('feedback.input');
    }

    public function edit(Feedback $feedback)
    {
        return view('feedback.edit', ['feedback' => $feedback]);
    }

    public function save(FeedbackRequest $request)
    {
        $text = '';
        if(!isset($request->id)) {
            $feedback = new Feedback();
            $text = 'добавлен';
        } else {
            $feedback = Feedback::findOrFail($request->id);
            $text = 'изменён';
        }
        $feedback->user_name = $request->user_name;
        $feedback->comment = $request->comment;

        if ($feedback->save()) {
            return redirect(action([__CLASS__, 'list'], ['feedbacks' => Feedback::all()]))
                ->with(['message' => "Отзыв от {$feedback->user_name} {$text}"]);
        } else {
            return back()->with(['errors' => "Ошибка при сохранении"]);
        }
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
