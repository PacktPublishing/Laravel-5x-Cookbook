<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $wish_lists = WishList::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

        return view('wish_lists.index', compact('wish_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('wish_lists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $wish_list = new WishList();

        $wish_list->comic_data = $request->input("comic_data");
        $wish_list->user_id = Auth::user()->id;

        $wish_list->save();

        return redirect()->route('wish_lists.index')->with('message', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $wish_list = WishList::findOrFail($id);

        return view('wish_lists.show', compact('wish_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $wish_list = WishList::findOrFail($id);

        return view('wish_lists.edit', compact('wish_list'));
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
        $wish_list = WishList::findOrFail($id);

        $wish_list->comic_data = $request->input("comic_data");
        $wish_list->user_id = Auth::user()->id;

        $wish_list->save();

        return redirect()->route('wish_lists.index')->with('message', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $wish_list = WishList::findOrFail($id);
        $wish_list->delete();

        return redirect()->route('wish_lists.index')->with('message', 'Item deleted successfully.');
    }
}
