<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Media;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
use Redirect;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{

	protected $rules = [
		'name' => ['required', 'min:3'],
	];
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$projects = Project::orderBy('created_at', 'desc')->get();
		
        return view('frontend.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.projects.create');
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

	protected function filter_project_input() {
		$input = Input::all();

		$input['slug'] = $this->makeSlugFromTitle($input['name']);

		foreach ( ['profile','cover'] as $name) {
			if (Input::file($name) && Input::file($name)->isValid()) {
				$res = \Cloudinary\Uploader::upload(Input::file($name)->getRealPath());	
				if ($res && isset($res['public_id'])) {
					$media = Media::create( ['public_id' => $res['public_id']] );
					$input[$name.'_media_id'] = $media->id;
				}
				unset($input[$name]);
			}
		}

		return $input;	
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->middleware('auth');
    	if ($user = auth()->user()) {
			$this->validate($request, $this->rules);
	
			$input = $this->filter_project_input();
			
			$project = Project::create( $input );
			
			$project->members()->attach($user->id,['role' => 'owner']);
		 
			return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Projeto criado.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('frontend.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('frontend.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
		$this->validate($request, $this->rules);

		$input = $this->filter_project_input();

		$input = array_except($input, '_method');

		$project->update($input);

		return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Projeto atualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
		$project->delete();
	 
		return Redirect::to('/')->with('flash_success', 'Projeto apagado.');
    }

    /**
     * Current user join project as member.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function join(Project $project)
    {
		$this->middleware('auth');
    	if ($user = auth()->user()) {
    		if ($project->ismember($user)) 
				$error = 'Você já faz parte do time do projeto/';
			else {
				$project->members()->attach($user->id,['role' => 'member']);
				return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Você entrou no time do projeto.');    	
			}
		} else
			$error = 'Operação não permitida.';
		
		return Redirect::route('projects.show', $project->slug)->with('flash_danger', $error);    	
	}

    /**
     * Current user leave project.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function leave(Project $project)
    {
		$this->middleware('auth');
    	if ($user = auth()->user()) {
    		if ($project->ismember($user,'member')) {
				$project->members()->detach($user->id);
				return Redirect::route('projects.show', $project->slug)
							->with('flash_success', 'Você saiu do time do projeto.');    	
    		} else {
    			if ($project->ismember($user,'owner')) {
    				$error = 'Donos de projeto não podem sair do time.';
    			} else {
    				$error = 'Você não faz parte do time do projeto.';
    			}
			}
		} else
			$error = 'Operação não permitida.';
		return Redirect::route('projects.show', $project->slug)->with('flash_danger', $error);    	
    	
	}

}
