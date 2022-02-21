<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use App\Repositories\BaseRepository;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Http;
use App\Models\Todo;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Pipeline\Pipeline;

class TodoController extends BaseRepository
{   
    use BaseResponse;

    public function __construct(Todo $model)
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
        $todo = Todo::orderBy('id', 'desc')->get();

        if($todo->count() > 0) {
            
            return $this->sendResponse($todo->toArray()
                        ,'Record retrieved successfully.');
        }
        else {
            return $this->sendResponse([],
                        'Sorry no record found');
        }
    }

    public function external_todos(Request $request)
    {

        $url = 'https://jsonplaceholder.typicode.com/todos';
      
        $responses = Http::get($url);
        $responses = $responses->json();
        foreach($responses as $response){
            $data = $response;
            $data['user_id'] = $response['userId']; 
            Todo::create($data);
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
        $params['user_id'] = 1;
        try {
            $todo = $this->save($params);

            return $this->sendResponse($todo->toArray(),
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
            return $this->sendError('todo not found');
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
        $todo = $this->findAndUpdate($request->all(), $id);
        $response = $this->find($id);
        return $this->sendResponse($response->toArray(),
            'Record Updated successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $todo = $this->find($id);
        $data = $this->delete($id);
        if($data){
            return $this->sendResponse([],'record deleted successfully.', 204);
        }
        else{
            return $this->sendError('todo not found');
        }
    }
}
