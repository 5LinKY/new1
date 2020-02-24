<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BlogPostCollection;
use App\BlogPost;
use App\CategoryAgeGroup;

class BlogPostController extends Controller
{
    public function store(Request $request)
    {
      $blogpost = new BlogPost([
        'title' => $request->get('title'),
        'category' => $request->get('category'),
        'age' => $request->get('age'),
        'description' => $request->get('description')
      ]);

      $blogpost->save();

      return response()->json('success');
    }


    public function index()
    {
       //$posts = BlogPost::all();
      //   //dd($posts);
      //   //return response(['post'=>$posts]);
        // return response()->json(['blogpost' => $posts]);
      $temp = CategoryAgeGroup::where(["category_id" => 1])->get();
      dd($temp);
    }

    public function edit($id)
    {
      $blogpost = BlogPost::find($id);
      return response()->json($blogpost);
    }

    public function update($id, Request $request)
    {
      $blogpost = BlogPost::find($id);

      $blogpost->update($request->all());

      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $blogpost = BlogPost::find($id);

      $blogpost->delete();

      return response()->json('successfully deleted');
    }



}

