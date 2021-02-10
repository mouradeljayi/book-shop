<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Str;

class BookController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('books.index', ['books' => Book::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
          "title" => "required",
          "category_id" => "required",
          "price" => "required",
          "description" => "required",
          "image" => "required|image|mimes:png,jpg,jpeg"
        ]);

        if($request->has('image'))
        {
          $file = $request->image;
          $imageName = time() . "_" . $file->getClientOriginalName();
          $file->move(public_path('images/books'), $imageName);

          Book::create([
            "title" => $request->title,
            "slug" => Str::slug($request->title),
            "description" => $request->description,
            "price" => $request->price,
            "old_price" => $request->old_price,
            "stock" => $request->stock,
            "category_id" => $request->category_id,
            "image" => $imageName,
          ]);
         }

        return back()->with('success', 'A book was added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $categories = Category::has("books")->get();
        return view('books.show',['book' => $book, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
      $this->validate($request,[
        "title" => "required",
        "category_id" => "required",
        "price" => "required",
        "description" => "required",
      ]);

      if($request->has('image'))
      {
        unlink(public_path('images/books/' . $book->image));
        $file = $request->image;
        $imageName = time() . "_" . $file->getClientOriginalName();
        $file->move(public_path('images/books'), $imageName);
        $book->image = $imageName;
      }

      $book->update([
        "title" => $request->title,
        "slug" => Str::slug($request->title),
        "description" => $request->description,
        "price" => $request->price,
        "old_price" => $request->old_price,
        "stock" => $request->stock,
        "category_id" => $request->category_id,
        "image" => $book->image,
      ]);

      return back()->with('success', 'A book was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        unlink(public_path('images/books/' . $book->image));
        $book->delete();
        return back()->with('success', 'You have deleted ' . $book->title);
    }
}
