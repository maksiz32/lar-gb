<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
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
