<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Redirect;
use Illuminate\Support\Str;

class TasksController extends Controller {
	protected $rules = [
		'name' => ['required', 'min:3'],
		'description' => ['required'],
	];
	 
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
	 * Create a conversation slug.
	 *
	 * @param  string $title
	 * @return string
	 */
	protected function makeSlugFromTitle($title)
	{
	    $slug = Str::slug($title);
	    $count = Project::whereRaw("slug LIKE '{$slug}-%' OR slug = '{$slug}'")->count();
	    return $count ? "{$slug}-{$count}" : $slug;
	}

	protected function filter_task_input() {
		$input = Input::all();

		$input['slug'] = $this->makeSlugFromTitle($input['name']);

		$input = array_except($input, '_method');
		return $input;	
	}
			
	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function create(Project $project)
	{
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user()) || access()->hasRole('Administrator') ) {
			return view('frontend.tasks.create', compact('project'));
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Project $project
     * @param  \Illuminate\Http\Request  $request
	 * @return Response
	 */
	public function store(Project $project, Request $request)
	{
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user()) || access()->hasRole('Administrator') ) {
			$this->validate($request, $this->rules);
	
			$input = $this->filter_task_input();

			$input['project_id'] = $project->id;

			Task::create( $input );
		 
			return Redirect::route('projects.show', $project->slug)->with('message', 'Nova tarefa criada.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
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
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user()) || access()->hasRole('Administrator') ) {
			return view('frontend.tasks.edit', compact('project', 'task'));
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Project $project
	 * @param  Task    $task
     * @param  \Illuminate\Http\Request  $request
	 * @return Response
	 */
	public function update(Project $project, Task $task, Request $request)
	{
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user()) || access()->hasRole('Administrator') ) {
			$this->validate($request, $this->rules);
	
			$input = $this->filter_task_input();

			$task->update($input);
		 
			return Redirect::route('projects.tasks.show', [$project->slug, $task->slug])->with('message', 'Tarefa atualizada.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
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
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user(),'owner') || access()->hasRole('Administrator') ) {
			$task->delete();
		 
			return Redirect::route('projects.show', $project->slug)->with('message', 'Tarefa removida.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
	}

}