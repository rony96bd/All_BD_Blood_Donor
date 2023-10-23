<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Donor;
use App\Models\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->guard('donor')->check()) {
            $donordetails_id = Donor::where('id', $request->donordetails_id)->first();
            if ($donordetails_id) {
                Comment::create([
                    'donor_id' => auth()->guard('donor')->user()->id,
                    'donordetails_id' => $donordetails_id->id,
                    'comment_body' => $request->comment_body,
                ]);
                $notify[] = ['success', 'Comment Successfuly'];
                return redirect()->back()->withNotify($notify);
            } else {
                $notify[] = ['success', 'Bad Request!'];
                return redirect()->back()->withNotify($notify);
            }
        } else {
            $notify[] = ['success', 'কমেন্ট করার জন্য অবশ্যই লগইন করুন।'];
            return redirect('/donor')->withNotify($notify);
        }
    }

    public function blogcommentStore(Request $request)
    {
        if (auth()->guard('donor')->check()) {
            $blog_id = $request->blog_id;

            if ($blog_id) {
                Comment::create([
                    'donor_id' => auth()->guard('donor')->user()->id,
                    'post_id' => $blog_id,
                    'comment_body' => $request->comment_body,
                ]);
                $notify[] = ['success', 'Comment Successfuly'];
                return redirect()->back()->withNotify($notify);
            } else {
                $notify[] = ['success', 'Bad Request!'];
                return redirect()->back()->withNotify($notify);
            }
        } else {
            $notify[] = ['success', 'কমেন্ট করার জন্য অবশ্যই লগইন করুন।'];
            return redirect('/donor')->withNotify($notify);
        }
    }

    public function bloodrequestcommentStore(Request $request)
    {
        if (auth()->guard('donor')->check()) {
            if ($request->bloodrequest_id) {
                Comment::create([
                    'donor_id' => auth()->guard('donor')->user()->id,
                    'bloodrequest_id' => $request->bloodrequest_id,
                    'comment_body' => $request->comment_body,
                ]);

                $notify[] = ['success', 'Comment Successfuly'];
                return redirect()->back()->withNotify($notify);
            } else {
                $notify[] = ['success', 'Bad Request!'];
                return redirect()->back()->withNotify($notify);
            }
        } else {
            $notify[] = ['success', 'কমেন্ট করার জন্য অবশ্যই লগইন করুন।'];
            return redirect('/donor')->withNotify($notify);
        }
    }
}
