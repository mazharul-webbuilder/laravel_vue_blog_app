<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $data = Post::where('user_id', \request()->user()->id)->orderBy('id', 'DESC')->get(['id', 'title', 'content', 'created_at as creation_date']);

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
            $data['user_id'] = $request->user()->id;

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
            throw new ValidationException($validator);
        }
        try {
            $post = Post::findOrFail($id);
            if ($post->user_id != $request->user()->id){
                return response()->json([
                    'message' => 'Invalid Action'
                ]);
            }
            $post->update($validator->validated());
            return response()->json([
                'data' => $post
            ]);
        } catch (ModelNotFoundException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
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
