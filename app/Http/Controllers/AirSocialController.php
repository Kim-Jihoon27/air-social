<?php

namespace App\Http\Controllers;

use App\Models\AirSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AirSocialController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/newsfeed');
        }

        return view('home');
    }

    public function newsfeed()
    {
        $air_post = AirSocial::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('newsfeed', ['air_post' => $air_post]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $userId = Auth::check() ? Auth::id() : null;

        DB::table('air_socials')->insert([
            'message' => $validated['message'],
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/newsfeed')->with('success', 'Air Post Created');
    }

    public function update(Request $request, string $id)
    {
        try {
            $post = AirSocial::findOrFail($id);

            file_put_contents(public_path('debug.txt'), "update: id=$id, post_user_id=".$post->user_id.', auth_id='.Auth::id().', request: '.json_encode($request->all())."\n", FILE_APPEND);

            if ($post->user_id !== Auth::id()) {
                return redirect('/newsfeed')->with('error', 'You can only edit your own posts!');
            }

            $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);

            DB::table('air_socials')
                ->where('id', $id)
                ->update([
                    'message' => $validated['message'],
                    'updated_at' => now(),
                ]);

            file_put_contents(public_path('debug.txt'), "update: success\n", FILE_APPEND);

            return redirect('/newsfeed?t='.time())->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            file_put_contents(public_path('debug.txt'), 'update: error - '.$e->getMessage()."\n", FILE_APPEND);

            return redirect('/newsfeed')->with('error', 'Update failed: '.$e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $post = AirSocial::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $post->delete();

        return redirect('/newsfeed')->with('success', 'Post deleted');
    }
}
