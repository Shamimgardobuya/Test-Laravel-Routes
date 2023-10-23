<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\storeTaskRequest as RequestsStoreTaskRequest;
use App\Http\Requests\V1\updateTaskRequest as RequestsUpdateTaskRequest;
use App\Http\Requests\V1\BulkTaskRequest;

use App\Http\Resources\V1\TaskResource;
use App\Http\Resources\V1\TaskCollection;

use Illuminate\Support\Arr;

use App\Models\Task;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    

        // $filter = new TaskQuery();
        // $queryTasks = $filter->transform($request)


        return new TaskCollection(Task::all());
    }


    
    public function store(RequestsStoreTaskRequest $request)
    {  
        $validatedInput = $request->validated();
        // dd($validatedInput->input('taskName'));
       return Task::create($request->all());
       

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsUpdateTaskRequest $request, Task $task)
    {
        return $task->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
    public function bulkstore(BulkTaskRequest $request)  //resource does not handle bulk function
    {
     $bulk = collect($request->all())->map(function($arr,$key){
        return Arr::except($arr, ['taskIdentifier','taskName']);  //having taskName made a duplicate exist in db, so had to add one

   });
   Task::insert($bulk->toArray());

    }
}
