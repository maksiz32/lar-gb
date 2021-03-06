<?php

namespace App\Http\Controllers\Feedback;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin')->except(['input', 'all', 'show', 'save']);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function input()
    {
        return view('feedback.input');
    }

    /**
     * @param Feedback $feedback
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Feedback $feedback)
    {
        return view('feedback.edit', ['feedback' => $feedback]);
    }

    /**
     * @param FeedbackRequest $request
     * @param Feedback $feedback
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FeedbackRequest $request, Feedback $feedback)
    {
        $feedback = $feedback->fill($request->validated());
        if ($feedback->save()) {
            return redirect(action([__CLASS__, 'list'], ['feedbacks' => Feedback::all()]))
                ->with(['message' => __('messages.admin.feedback.update.success')]);
        }

        return back()->with(['errors' => __('messages.admin.feedback.update.fail')]);
    }

    /**
     * @param FeedbackRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(FeedbackRequest $request)
    {
        $feedback = Feedback::create($request->validated());
        if ($feedback->save()) {
            return redirect(action([__CLASS__, 'list'], ['feedbacks' => Feedback::all()]))
                ->with(['message' => __('messages.admin.feedback.create.success')]);
        }

        return back()->with(['errors' => __('messages.admin.feedback.create.fail')]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all()
    {
        return view('feedback.all', ['feedbacks' => Feedback::paginate(3)]);
    }

    public function list()
    {
        return view('admin.feedbacks', ['feedbacks' => Feedback::paginate(3)]);
    }

    /**
     * @param Feedback $feedback
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Feedback $feedback)
    {
        return view('feedback.one', ['feedback' => $feedback]);
    }

    /**
     * @param Feedback $feedback
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();

            return response()->json(['message' => __('messages.admin.feedback.destroy.success')]);
        } catch (\Exception $e) {
            \Log::error($e->getMessage() . PHP_EOL, $e->getTrace());

            return response()->json(['message' => __('messages.admin.feedback.destroy.fail')]);
        }
    }
}
