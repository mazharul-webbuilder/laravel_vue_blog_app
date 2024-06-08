<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $data = Post::all();

            return response()->json([
                'data' => $data
            ]);

        }catch (QueryException|Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->check() ? auth()->guard('api')->id() : User::all()->random()->id;

            $post = Post::create($data);

            return response()->json([
                'data' => $post,
            ]);
        } catch (Exception $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            return response()->json([
                'data' => Post::findOrFail($id)
            ]);
        } catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
       // Validate data
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'content' => ['required', 'string', 'min:10']
        ]);

        if ($validator->fails()){
            return response()->json([
                'message' => $validator->messages(),
            ]);
        }
        try {
            $post = Post::findOrFail($id);
            $post->update($validator->validated());
            return response()->json([
                'data' => $post
            ]);
        } catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return response()->json([
                'message' => 'Post deleted successfully'
            ]);
        } catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        }
    }
}