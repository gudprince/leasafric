<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BaseRepository;
use App\Traits\BaseResponse;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;


class UserController extends BaseRepository
{
    //

    use BaseResponse;

    public function __construct(User $model)
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
        $users = User::all();

        if($users->count() > 0) {
            
            return $this->sendResponse($users->load('address.geo', 'company')->toArray()
                        ,'Record retrieved successfully.');
        }
        else {
            return $this->sendResponse([],
                        'Sorry no record found');
        }
    }

    public function external_users(Request $request)
    {

        $url = 'https://jsonplaceholder.typicode.com/users';
      
        $responses = Http::get($url);
        $responses = $responses->json();
        foreach($responses as $response){
        
           $data =  User::create($response);
           $address =  $data->address()->create($response['address']);
           $address->geo()->create($response['address']['geo']);
           $data->company()->create($response['company']);
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
            return $this->sendError('user not found');
        }
    }

    public function user_posts($id)
    {   
     
        $response = $this->find($id);
        if($response){
        return $this->sendResponse($response->posts->toArray(),
            'Record retrieved successfully.', 201);
        }
        else{
            return $this->sendError('user not found');
        }
    }
    public function user_todos($id)
    {   
     
        $response = $this->find($id);
        if($response){
        return $this->sendResponse($response->todos->toArray(),
            'Record retrieved successfully.', 201);
        }
        else{
            return $this->sendError('record not found');
        }
    }

    public function user_albums($id)
    {   
     
        $response = $this->find($id);
        if($response){
        return $this->sendResponse($response->albums->toArray(),
            'Record retrieved successfully.', 201);
        }
        else{
            return $this->sendError('record not found');
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
