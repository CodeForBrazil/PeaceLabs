<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Redirect;

class TasksController extends Controller {
 
	/**
	 * Display a listing of the resource.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function index(Project $project)
	{
		return view('frontend.tasks.index', compact('project'));
	}
 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function create(Project $project)
	{
		return view('frontend.tasks.create', compact('project'));
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function store(Project $project)
	{
		$input = Input::all();
		$input['project_id'] = $project->id;
		Task::create( $input );
	 
		return Redirect::route('projects.show', $project->slug)->with('message', 'Nova tarefa criada.');
	}
 
	/**
	 * Display the specified resource.
	 *
	 * @param  Project $project
	 * @param  Task    $task
	 * @return Response
	 */
	public function show(Project $project, Task $task)
	{
		return view('frontend.tasks.show', compact('project', 'task'));
	}
 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project $project
	 * @param  Task    $task
	 * @return Response
	 */
	public function edit(Project $project, Task $task)
	{
		return view('frontend.tasks.edit', compact('project', 'task'));
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Project $project
	 * @param  Task    $task
	 * @return Response
	 */
	public function update(Project $project, Task $task)
	{
		$input = array_except(Input::all(), '_method');
		$task->update($input);
	 
		return Redirect::route('projects.tasks.show', [$project->slug, $task->slug])->with('message', 'Tarefa atualizada.');
	}
 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Project $project
	 * @param  Task    $task
	 * @return Response
	 */
	public function destroy(Project $project, Task $task)
	{
		$task->delete();
	 
		return Redirect::route('projects.show', $project->slug)->with('message', 'Tarefa removida.');
	}

}