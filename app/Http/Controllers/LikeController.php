<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Artikel $artikel)
    {
        $like = Like::where('artikel_id', $artikel->id)
                   ->where('user_id', Auth::id())
                   ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'artikel_id' => $artikel->id,
                'user_id' => Auth::id()
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $artikel->likes()->count()
        ]);
    }
}