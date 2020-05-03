<?php

namespace App\Http\Controllers;

use App\Tag;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return auth()->user()->tags()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Tag|Model
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'color' => 'required'
        ]);
        $request->merge([
            'user_id' => auth()->user()->id,
            'created_at' => now()
        ]);
        return Tag::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Tag|Tag[]|Collection|Model
     */
    public function show($id)
    {
        return Tag::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Tag|Tag[]|Collection|Model
     */
    public function update(Request $request, $id)
    {
        // Param "_method" with value "PATCH" or "PUT" is required to work with Postman
        // TODO -> Check if is required in the app

        $request->validate([
            'title' => 'required',
            'color' => 'required'
        ]);
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return $tag;
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

        $tag = Tag::findOrFail($id);
        $tag->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
