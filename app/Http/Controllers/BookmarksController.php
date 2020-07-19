<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'order' => 'required|in:default,oldest_to_newest,a_to_z,z_to_a'
        ]);
        $bookmarks = auth()->user()->bookmarks();
        switch ($request->get('order')) {
            case 'default': {
                $bookmarks = $bookmarks->orderBy('created_at', 'DESC');
            }
            break;
            case 'oldest_to_newest': {
                $bookmarks = $bookmarks->orderBy('created_at', 'ASC');
            }
            break;
            case 'a_to_z': {
                $bookmarks = $bookmarks->orderBy('title', 'ASC');
            }
            break;
            case 'z_to_a': {
                $bookmarks = $bookmarks->orderBy('title', 'DESC');
            }
            break;
        }
        return $bookmarks->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Bookmark|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'color' => 'required'
        ]);
        $request->merge([
            'id' => guid(),
            'user_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return Bookmark::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function show($id)
    {
        return Bookmark::findOrFail($id)
                        ->with('folder', 'tag')
                        ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Bookmark|Bookmark[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request, $id)
    {
        // Param "_method" with value "PATCH" or "PUT" is required to work with Postman
        // TODO -> Check if is required in the app

        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'color' => 'required'
        ]);
        $request->merge([
            'updated_at' => now()
        ]);
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->update($request->all());
        return $bookmark;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        // Param "_method" with value "DELETE" is required to work with Postman
        // TODO -> Check if is required in the app

        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
