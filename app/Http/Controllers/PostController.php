<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
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
		$data = $request->input();
		$data['user_id'] = 1;
		$data['content_row'] = strip_tags($data['content_html']);
		$data['excerpt'] = \Str::words($data['content_row'], 10,'...');

		if(empty($data['slug'])){
			$data['slug'] = str_slug($data['title']);
		}

		$post = (new Post())->create($data);

		if($post){
			return redirect('/posts')
				->with(['success' => 'Успішно додано']);
		} else {
			return back()->withErrors(['msq' => 'Помилка додавання'])
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
		$post = $this->postRepository->getPost($id);

		$data = $request->input();
		$data['content_row'] = strip_tags($data['content_html']);
		$data['excerpt'] = \Str::words($data['content_row'], 10,'...');

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
        $post->delete();
        return redirect('/posts')->with(['success' => "Пост успішно видалено"]);;
    }
}
