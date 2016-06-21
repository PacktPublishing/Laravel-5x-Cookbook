<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MarkDownHelper;

class BlogController extends Controller {

	use MarkDownHelper;
	
	public function __construct()
	{
		$this->middleware('is_admin', ['except' => ['index',  'show']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$blogs = Blog::where('active', '1')->orderBy('created_at', 'desc')->paginate(5);
		
		if( !Auth::guest() && Auth::user()->id == 1 )
		{
			$blogs = Blog::orderBy('created_at', 'desc')->paginate(100);
		}

		$title = "News and Blog";
		
		return view('blogs.index', compact('blogs', 'title'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('blogs.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$blog = new Blog();

		if($request->file())
		{
			$image = $request->file('image');

			$image->move(storage_path('app/uploads/'), $image->getClientOriginalName());

			$image_name = $image->getClientOriginalName();
		} else {
			$image_name = false;
		}

		$blog->title    = $request->input("title");
		$blog->body     = $request->input("body");
		$blog->intro    = $request->input("intro");
		$blog->image    = ($image_name) ?:'';
		$blog->active   = ($request->input("active") && $request->input("active") == 'on') ? 1 : 0;

		$blog->save();

		return redirect()->route('blogs.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$blog = Blog::findOrFail($id);

		$blogs = Blog::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);

		$title = $blog->title;

		return view('blogs.show', compact('blog', 'blogs', 'title'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$blog = Blog::findOrFail($id);

		return view('blogs.edit', compact('blog'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$blog = Blog::findOrFail($id);

		if($request->file())
		{
			$image = $request->file('image');

			$image->move(storage_path('public/images'), $image->getClientOriginalName());

			$image_name = $image->getClientOriginalName();
		} else {
			$image_name = $blog->image;
		}

		$blog->title    		= $request->input("title");
		$blog->mark_down     	= $request->input("mark_down");
		$blog->html     		= $this->getMarkdownTool()->defaultTransform($request->input("mark_down"));
		$blog->intro    		= $request->input("intro");
		$blog->image    		= $image_name;
		$blog->active   		= ($request->input("active") && $request->input("active") == 'on') ? 1 : 0;

		//Set URL

		$blog->save();

		return redirect()->route('blogs.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$blog = Blog::findOrFail($id);
		$blog->delete();

		return redirect()->route('blogs.index')->with('message', 'Item deleted successfully.');
	}

}
