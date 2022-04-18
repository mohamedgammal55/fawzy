<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovesResource;
use App\Http\Resources\ShowResource;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function posts($type, Request $request)
    {
        $data = Posts::where('type', $type)->latest();

        if ($request->has('category_id') &&
            $request->category_id != null &&
            $request->category_id != '')
            $data->where('category_id', $request->category_id);


        if ($request->has('title') &&
            $request->title != null &&
            $request->title != '')
            $data->where('title', 'LIKE', '%' . $request->title . '%');

        $data = $this->{$type.'s'}($data->get());
        return $data;
    }//end fun
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function moves($data)
    {
        return helperJson(MovesResource::collection($data));
    }//end fun
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function shows($data)
    {
        return helperJson(ShowResource::collection($data));
    }//end fun
    //================= one post =============

    public function onePost(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'post_id' => 'required|exists:posts,id',
        ]);

        if ($validator->fails()){
            return helperJson(null, $validator->errors(),509);
        }
        $post = Posts::findOrFail($request->post_id);
        $data = $this->{$post->type}($post);
        return $data;
    }//end fun
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function move($data)
    {
        return helperJson(new MovesResource($data));
    }//end fun
    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    private function show($data)
    {
        return helperJson(new ShowResource($data));
    }//end fun

}//end class
