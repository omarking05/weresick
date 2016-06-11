<?php

namespace App\Http\Controllers;

use App\Post;
use App\Journal;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user's journal.
     *
     * @return \Illuminate\Http\Response
     */
    public function myJournal(Request $request)
    {
        $journal_id = $request->user()->journal_id;
        return redirect('/journal/'.$journal_id);
    }

    public function getJournal(Request $request)
    {
        $journal_id = $request->id;
        $journal = Journal::find($journal_id);
        $posts = Post::where('journal_id', $journal_id)->get();
        return view('journal', [
            'posts' => $posts,
            'journal' => $journal,
        ]);
    }

    public function newsFeed()
    {
        // TODO: show posts for related tags that the user has recently used
        $journals = Journal::all();
        return view('welcome', [
            'journals' => $journals
        ]);
    }
}