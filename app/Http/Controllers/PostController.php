<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use App\Post;
use App\Image;

class PostController extends Controller
{

	/**
	 * @var PostRepository
	 */
	private $postRepository;

	/**
	 * PostController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->postRepository = app(PostRepository::class);
		$this->middleware('auth', ['except' => ['index', 'show']]);
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$paginator = $this->postRepository->getAllWithPaginate(8);

    	return view('posts.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	if(\Gate::denies('add', Post::class)){
    		return redirect()
				->back()
				->with(['error' => 'Обмеження прав доступу. Потрібні права адміністратора або редактора']);
		}

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
    	//Upload image
		if($request->hasFile('cover_image')){
			//name with extention
			$filenameWithExt = $request->file('cover_image')->getClientOriginalName();
			//only name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//only extention
			$extention = $request->file('cover_image')->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extention;
			//Upload
			$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

		} else {
			$fileNameToStore = 'no_image.jpg';
		}

    	//Create post
		$data = $request->input();
		$data['user_id'] = auth()->user()->id;
		$data['content_row'] = strip_tags($data['content_html']);
		$data['excerpt'] = \Str::words($data['content_row'], 10,'...');
		//for image
		$data['cover_image'] = $fileNameToStore;

		if(empty($data['slug'])){
			$data['slug'] = str_slug($data['title']);
		}

		$post = (new Post())->create($data);

		if($post){
			return redirect('/posts')
				->with(['success' => 'Успішно додано']);
		} else {
			return back()->withErrors(['msg' => 'Помилка додавання'])
				->withInput();
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
		$post = $this->postRepository->getPost($id);
		abort_if(!$post, 404);

		return view('posts.show', compact('post'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$post = $this->postRepository->getPost($id);
		abort_if(!$post, 404);

		if(\Gate::denies('update', $post)){
			return redirect()
				->back()
				->with(['error' => 'Обмеження прав доступу. Зверніться до адміністратора']);
		}

		return view('posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {

		//Upload image
		if($request->hasFile('cover_image')){
			//name with extention
			$filenameWithExt = $request->file('cover_image')->getClientOriginalName();
			//only name
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			//only extention
			$extention = $request->file('cover_image')->getClientOriginalExtension();
			//Filename to store
			$fileNameToStore = $filename.'_'.time().'.'.$extention;
			//Upload
			$path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
		}

		//post update
		$post = $this->postRepository->getPost($id);

		$data = $request->input();
		$data['content_row'] = strip_tags($data['content_html']);
		$data['excerpt'] = \Str::words($data['content_row'], 10,'...');
		if($request->hasFile('cover_image')){
			$data['cover_image'] = $fileNameToStore;
		}

		if(empty($data['slug'])){
			$data['slug'] = str_slug($data['title']);
		}

		$result = $post->update($data);

		if($result){
			return redirect()
				->route('posts.edit', $id)
				->with(['success' => "Успішно збережено"]);
		} else {
			return back()
				->withErrors(['msg' => "Помилка збереження"])
				->withInput();
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
        $post = Post::find($id);

		if(\Gate::denies('delete', $post)){
			return redirect()
				->back()
				->with(['error' => 'Обмеження прав доступу. Зверніться до адміністратора']);
		}

		if($post->cover_image != 'no_image.jpg'){
			//delete image
			Storage::delete('public/cover_images/'.$post->cover_image);
		}

        $post->delete();
        return redirect('/posts')->with(['success' => "Пост успішно видалено"]);
    }
}
