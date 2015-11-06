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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, $this->rules);

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
		
		$project = Project::create( $input );
	 
		return Redirect::route('projects.show', $project->slug)->with('flash_success', 'Projeto criado ');
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

		$input = array_except(Input::all(), '_method');
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
}
