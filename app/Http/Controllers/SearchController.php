<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Folder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3'
        ]);
        $likeQuery = '%' . $request->get('query') . '%';
        $bookmarks = auth()->user()->bookmarks()
                            ->where('title', 'LIKE',$likeQuery)
                            ->orWhere('url', 'LIKE', $likeQuery)
                            ->orWhere('note', 'LIKE', $likeQuery)
                            ->orderBy('created_at', 'DESC')
                            ->get();
        $folders = auth()->user()->folders()
            ->where('name', 'LIKE', $likeQuery)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->json(compact('bookmarks', 'folders'));
    }
}
