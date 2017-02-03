<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\BlogComment;
use App\Http\Requests;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Requests\BlogRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Response;
use Sentinel;


class BlogController extends JoshController
{


    private $tags;

    public function __construct()
    {
        parent::__construct();
        $this->tags = Blog::tagArray();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getIndexFrontend()
    {
        // Grab all the blogs
        $blogs = Blog::latest()->simplePaginate(5);
        $blogs->setPath('blog');
        $tags = $this->tags;
        // Show the page
        return View('blog', compact('blogs', 'tags'));
    }

    /**
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function getBlogFrontend($slug = '')
    {
        if ($slug == '') {
            $blog = Blog::first();
        }
        try {
            $blog = Blog::findBySlugOrIdOrFail($slug);
            $blog->increment('views');
        } catch (ModelNotFoundException $e) {
            return Response::view('404', array(), 404);
        }
        // Show the page
        return View('blogitem', compact('blog'));

    }

    /**
     * @param $tag
     * @return \Illuminate\View\View
     */
    public function getBlogTagFrontend($tag)
    {
        $blogs = Blog::withAnyTags($tag)->simplePaginate(5);
        $blogs->setPath('blog/' . $tag . '/tag');
        $tags = $this->tags;
        return View('blog', compact('blogs', 'tags'));
    }

    /**
     * @param BlogCommentRequest $request
     * @param Blog $blog
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeCommentFrontend(BlogCommentRequest $request, Blog $blog)
    {
        $blogcooment = new BlogComment($request->all());
        $blogcooment->blog_id = $blog->id;
        $blogcooment->save();

        return redirect('blogitem/' . $blog->slug);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Grab all the blogs
        $blogs = Blog::all();
        // Show the page
        return View('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $blogcategory = BlogCategory::lists('title', 'id');
        return view('admin.blog.create', compact('blogcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(BlogRequest $request)
    {
        $blog = new Blog($request->except('image', 'tags'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/blog/';
            $picture = str_random(10) . '.' . $extension;
            $blog->image = $picture;
        }
        $blog->user_id = Sentinel::getUser()->id;
        $blog->save();

        if ($request->hasFile('image')) {
            $destinationPath = public_path() . $folderName;
            $request->file('image')->move($destinationPath, $picture);
        }

        $blog->tag($request->tags);

        if ($blog->id) {
            return redirect('admin/blog')->with('success', trans('blog/message.success.create'));
        } else {
            return Redirect::route('admin/blog')->withInput()->with('error', trans('blog/message.error.create'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  Blog $blog
     * @return view
     */
    public function show(Blog $blog)
    {
        $comments = BlogComment::all();
        return view('admin.blog.show', compact('blog', 'comments', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Blog $blog
     * @return view
     */
    public function edit(Blog $blog)
    {
        $blogcategory = BlogCategory::lists('title', 'id');
        return view('admin.blog.edit', compact('blog', 'blogcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/blog/';
            $picture = str_random(10) . '.' . $extension;
            $blog->image = $picture;
        }

        if ($request->hasFile('image')) {
            $destinationPath = public_path() . $folderName;
            $request->file('image')->move($destinationPath, $picture);
        }
        $blog->retag($request['tags']);

        if ($blog->update($request->except('image', '_method', 'tags'))) {
            return redirect('admin/blog')->with('success', trans('blog/message.success.update'));
        } else {
            return Redirect::route('admin/blog')->withInput()->with('error', trans('blog/message.error.update'));
        }
    }

    /**
     * Remove blog.
     *
     * @param $website
     * @return Response
     */
    public function getModalDelete(Blog $blog)
    {
        $model = 'blog';
        $confirm_route = $error = null;
        try {
            $confirm_route = route('delete/blog', ['id' => $blog->id]);
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        } catch (GroupNotFoundException $e) {

            $error = trans('blog/message.error.delete', compact('id'));
            return View('admin/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Blog $blog)
    {

        if ($blog->delete()) {
            return redirect('admin/blog')->with('success', trans('blog/message.success.delete'));
        } else {
            return Redirect::route('admin/blog')->withInput()->with('error', trans('blog/message.error.delete'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storecomment(BlogCommentRequest $request, Blog $blog)
    {
        $blogcooment = new BlogComment($request->all());
        $blogcooment->blog_id = $blog->id;
        $blogcooment->save();

        return redirect('admin/blog/' . $blog->id . '/show');
    }
}
