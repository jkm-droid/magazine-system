<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    //show all notifications to admins only
    public function show_all_notifications(){
        $notifications = auth()->user()->unreadNotifications;

        return view('dashboard.notifications.index', compact('notifications'));
    }

    //mark a single notification as read
    public function mark_as_read(Request $request){
        $notification_id = $request->notification_id;
        $unread = auth()->user()->unreadNotifications->where('id', $notification_id)->first();

        if ($unread){
            $unread->markAsRead();
        }

        $data = array(
            'status'=>200,
            'message'=>'Marked as read',
        );

        return response()->json($data);
    }

    //publish article
    public function publish_article(Request $request){
        if ($request->user('admin')->can('publish-article')) {
            if ($request->ajax()) {
                $article_id = $request->article_id;
                $article = Article::find($article_id);
                $article->status = 1;
                $article->update();

                $data  = array(
                    'status'=>200,
                    'message'=>"Article updated successfully"
                );

                return response()->json($data);
            }
        }

        $data  = array(
            'status'=>201,
            'message'=>"you lack permission to perform action"
        );

        return response()->json($data);

    }
}
