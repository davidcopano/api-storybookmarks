<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Folder;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return auth()->user()
                    ->folders()
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
    }

    public function getBookmarksById($id, Request $request)
    {
        return Bookmark::where('folder_id', $id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
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
     * @return Folder|\Illuminate\Database\Eloquent\Model
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
        $request->merge([
            'id' => guid(),
            'user_id' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return Folder::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Folder|Folder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return Folder::findOrFail($id);
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
     * @return Folder|Folder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update(Request $request, $id)
    {
        // Param "_method" with value "PATCH" or "PUT" is required to work with Postman
        // TODO -> Check if is required in the app

        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
        $request->merge([
            'updated_at' => now()
        ]);
        $folder = Folder::findOrFail($id);
        $folder->update($request->all());
        return $folder;
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

        $folder = Folder::findOrFail($id);
        $folder->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
