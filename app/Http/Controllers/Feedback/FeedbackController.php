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
        if($id = (int) $request->id) {
            /** @var Feedback $feedback */
            $feedback = Feedback::query()->find($id);
        }
        return view('feedback.input', ['userName' => $feedback->user_name, 'comment' => $feedback->comment]);
    }
    public function save(Request $request)
    {
        $validated = $request->validate(
            [
                'user_name' => 'required|string',
                'comment' => 'required|string',
            ]
        );
        $result = json_encode([
            'user_name' => $validated['user_name'],
            'comment' => $validated['comment'],
        ], JSON_PRETTY_PRINT);
        $fileName = time() . '_' . uniqid('', false) . '.txt';
        Storage::disk('my_files')
            ->put('feedback/' . $fileName, $result);

        return view('welcome')->with(['message' => "Файл $fileName у спешно записан"]);
    }
}
