<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use App\Models\Like;
use App\Models\Nice;
use App\Models\Follow;
// use App\Models\Follower;
use App\Models\User;

class FollowsController extends Controller
{
    public function followList(Post $post, Follow $follow)
    {
        $user = auth()->user();
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('followed_id')->toArray();
        $timelines = $post->getTimelines($user->id, $following_ids);
        return view('follows.followList',['timelines' => $timelines]);
    }
}
