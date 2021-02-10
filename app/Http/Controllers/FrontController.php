<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class FrontController extends Controller
{
    public function index()
    {
      $books = Book::latest()->paginate(6);
      $categories = Category::has("books")->get();
      return view('welcome', ['books' => $books, 'categories' => $categories]);
    }

    public function getBooksByCategory(Category $category)
    {
      $books = $category->books()->paginate(6);
      $categories = Category::has("books")->get();
      return view('welcome', ['books' => $books, 'categories' => $categories]);
    }
}
