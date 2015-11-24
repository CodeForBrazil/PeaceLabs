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
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Project $project)
    {
		$user_id =  ( auth()->user() )? auth()->user()->id : 0;
    	$project->views()->attach($user_id,['ip' => $request->ip()]);
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
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user(),'owner') || access()->hasRole('Administrator') ) {
	        return view('frontend.projects.edit', compact('project'));
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
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
		$this->middleware('auth');
    	if ( $project->ismember(auth()->user(),'owner') || access()->hasRole('Administrator') ) {
			$this->validate($request, $this->rules);
	
			$input = $this->filter_project_input();
	
			$input = array_except($input, '_method');
	
			$project->update($input);
	
			return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Projeto atualizado.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
		$this->middleware('auth');
    	if (access()->hasRole('Administrator')) {
			$project->delete();
	 
			return Redirect::to('/')->with('flash_success', 'Projeto apagado.');
    	} else {
			return Redirect::route('home')->with('flash_danger','Operação não permitida.');
		}
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

    /**
     * Current user likes a project.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function like(Project $project)
    {
		$this->middleware('auth');
    	if ($user = auth()->user()) {
			$project->likes()->sync([$user->id],false);
			return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Você curtiu o projeto.');    	
		} else
			$error = 'Operação não permitida.';
		
		return Redirect::route('projects.show', $project->slug)->with('flash_danger', $error);    	
	}

    /**
     * Current user dislikes a project.
     *
     * @param  \App\Model\Project $project
     * @return \Illuminate\Http\Response
     */
    public function dislike(Project $project)
    {
		$this->middleware('auth');
    	if ($user = auth()->user()) {
			$project->likes()->detach($user->id);
			return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Você descurtiu o projeto.');    	
		} else
			$error = 'Operação não permitida.';
		
		return Redirect::route('projects.show', $project->slug)->with('flash_danger', $error);    	
	}

}
