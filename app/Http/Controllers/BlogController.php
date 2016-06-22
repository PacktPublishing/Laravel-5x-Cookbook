<?php namespace App\Http\Controllers;

use App\Http\Requests;

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

	public function create()
	{
		$blog = new Blog();
		return view('blogs.create', compact("blog"));
	}

	public function store(Request $request)
	{
		$blog = new Blog();

		$image_name = $this->setFileFromRequest($request);

		$blog->title    		= $request->input("title");
		$blog->mark_down     	= $request->input("mark_down");
		$blog->intro    		= $request->input("intro");
		$blog->html     		= $this->getMarkdownTool()->defaultTransform($request->input("mark_down"));
		$blog->intro    		= $request->input("intro");
		$blog->image   			= ($image_name) ? $image_name : null;
		$blog->active   		= ($request->input("active") && $request->input("active") == 'on') ? 1 : 0;

		$blog->save();

		return redirect()->route('blogs.index')->with('message', 'Item created successfully.');
	}

	public function show($id)
	{
		if(is_numeric($id)) {
			$blog = Blog::findOrFail($id);
		} else {
			$blog = Blog::where('url', $id)->firstOrFail();
		}

		$blogs = Blog::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
		$title = $blog->title;
		return view('blogs.show', compact('blog', 'blogs', 'title'));
	}

	public function edit($id)
	{
		$blog = Blog::findOrFail($id);
		return view('blogs.edit', compact('blog'));
	}

	public function update(Request $request, $id)
	{
		$blog = Blog::findOrFail($id);

		$image_name = $this->setFileFromRequest($request);

		$blog->title    		= $request->input("title");
		$blog->mark_down     	= $request->input("mark_down");
		$blog->html     		= $this->getMarkdownTool()->defaultTransform($request->input("mark_down"));
		$blog->intro    		= $request->input("intro");
		$blog->image    		= (!$image_name) ? $blog->image : $image_name;
		$blog->active   		= ($request->input("active") && $request->input("active") == 'on') ? 1 : 0;

		$blog->save();

		return redirect()->route('blogs.index')->with('message', 'Item updated successfully.');
	}

	private function setFileFromRequest($request)
	{
		$image_name = false;

		if($request->file())
		{
			$image = $request->file('image');

			$image->move(storage_path('public/images'), $image->getClientOriginalName());

			return $image->getClientOriginalName();

		}

		return $image_name;
	}

	public function destroy($id)
	{
		return redirect()->route('blogs.index')->with('message', 'Oops no delete just yet');
	}


}
