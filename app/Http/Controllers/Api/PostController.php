<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class PostController extends BaseRepository
{
    use BaseResponse;

    public function __construct(Post $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        if($posts->count() > 0) {
            
            return $this->sendResponse($posts->toArray()
                ,'Record retrieved successfully.');
        }
        else {
            return $this->sendResponse([],
                'Sorry no record found');
        }
    }

    public function external_posts(Request $request)
    {

        $url = 'https://jsonplaceholder.typicode.com/posts';
        $comment_url = 'https://jsonplaceholder.typicode.com/comments';
      
        $responses = Http::get($url);
        $comments = Http::get($comment_url);
        $responses = $responses->json();
        $comments = $comments->json();
        foreach($responses as $response){
        
            $data = $response;
            $data['user_id'] = $response['userId']; 
            $post = Post::create($data);
            
        }
        foreach($comments as $comment){
            $data = $comment;
            $data['post_id'] = $comment['postId']; 
            Comment::create($data);
            
        }
            
         
        return $this->sendResponse($responses,'Record retrieved successfully.');
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $params = $request->all();
        try {
            /** resource will not be really created 
             *  but it will be faked as if  
             **/

            return $this->sendResponse($params,
                'Record Added successfully.', 201);

        } catch (ModelNotFoundException $e) {

            throw new InvalidArgumentException($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
     
        $response = $this->find($id);
        if($response){
        return $this->sendResponse($response->toArray(),
            'Record Added successfully.', 201);
        }
        else{
            return $this->sendError('post not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /** resource will not be really updated 
        *  but it will be faked as if  
        **/

        return $this->sendResponse($request->all(),
            'Record Updated successfully.', 200);
    }

    public function post_comments($id)
    {   
     
        $response = $this->find($id);
        if($response){
        return $this->sendResponse($response->comments->toArray(),
            'Record retrieved successfully.', 201);
        }
        else{
            return $this->sendError('user not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        /** resource will not be really deleted 
        *  but it will be faked as if  
        **/
        return $this->sendResponse(['id'=>$id],'record deleted successfully.', 204);
       
    }
}
