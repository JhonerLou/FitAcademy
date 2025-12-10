<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request): View
    {

        $query = ForumThread::with('user')->withCount('posts');


        if ($request->has('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $threads = $query->orderBy('is_pinned', 'desc')
                         ->latest()
                         ->paginate(10);

        return view('member.forum.index', compact('threads'));
    }


    public function create(): View
    {
        return view('member.forum.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:General,Training,Nutrition,Form Check,Off Topic',
            'content' => 'required|string|min:10',
        ]);

        $thread = ForumThread::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'category' => $validated['category'],
            'content' => $validated['content'],
            'views' => 0,
            'is_pinned' => false,
        ]);

        return redirect()->route('member.forum.show', $thread)->with('success', 'Thread created successfully!');
    }


    public function show(ForumThread $thread): View
    {

        $thread->increment('views');

        $posts = $thread->posts()->with('user')->oldest()->paginate(15);

        return view('member.forum.show', compact('thread', 'posts'));
    }


    public function reply(Request $request, ForumThread $thread): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|min:2',
        ]);

        ForumPost::create([
            'user_id' => Auth::id(),
            'forum_thread_id' => $thread->id,
            'content' => $validated['content'],
        ]);

        return redirect()->route('member.forum.show', $thread)->with('success', 'Reply posted!');
    }
}
