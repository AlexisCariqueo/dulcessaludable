<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CategoriaBlog;
use Illuminate\Http\Request;
use Cocur\Slugify\Slugify;
use Illuminate\Pagination\Paginator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
    
        if ($request->has('searchId') && trim($request->searchId) !== '') {
            $query->where('id', $request->searchId);
        }
    
        if ($request->has('searchTitle') && trim($request->searchTitle) !== '') {
            $query->where('title', 'like', '%' . $request->searchTitle . '%');
        }
    
        if ($request->has('searchCategory') && trim($request->searchCategory) !== '') {
            $query->whereHas('categoria', function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->searchCategory . '%');
            });
        }
    
        if ($request->has('searchStatus') && trim($request->searchStatus) !== '') {
            $query->where('status', $request->searchStatus);
        }
    
        $posts = $query->paginate(10);
    
        return view('admin.blog.index', ['posts' => $posts]);
    }
    
    
    public function create()
    {
        $categorias = CategoriaBlog::all();
        return view('admin.blog.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categoria_id' => 'nullable|exists:categoria_blog,id',
            'status' => 'required|in:publicado,borrador,archivado',
            'published_at' => 'nullable|date',
        ]);

        $featured_image = null;
        if ($request->hasFile('featured_image')) {
            $featured_image = $request->file('featured_image')->store('public');
        }

        $slugify = new Slugify();

        $tagsArray = explode(',', $request->get('tags'));

        
        $tagsJson = json_encode($tagsArray);

        $post = new Post([
            'title' => $request->input('title'),
            'slug' => $slugify->slugify($request->input('title')),
            'excerpt' => $request->input('excerpt'),
            'content' => $request->input('content'),
            'featured_image' => $featured_image,
            'categoria_id' => $request->input('categoria_id'),
            'tags' => $tagsJson, 
            'status' => $request->input('status'),
            'published_at' => $request->input('published_at'),
        ]);

        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('admin.blog.index')->with([
            'message' => 'Entrada de blog creada con éxito.',
            'message_type' => 'success',
        ]);

    }

    public function edit($id)
    {
    $post = Post::findOrFail($id);
    $categorias = CategoriaBlog::all();
    
    return view('admin.blog.edit', compact('post', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categoria_id' => 'nullable|exists:categoria_blog,id',
            'status' => 'required|in:publicado,borrador,archivado',
            'published_at' => 'nullable|date',
        ]);
    
        $post = Post::findOrFail($id);
    
        $slugify = new Slugify();
        $post->title = $request->input('title');
        $post->slug = $slugify->slugify($request->input('title'));
        $post->excerpt = $request->input('excerpt');
        $post->content = $request->input('content');
        $post->categoria_id = $request->input('categoria_id');
    
        $tags = $request->input('tags');
    
        
        $tagsDecoded = json_decode($tags);
    
        
        $tagsJson = json_encode(is_array($tagsDecoded) ? $tagsDecoded : explode(',', $tags));
    
        $post->tags = $tagsJson;
    
        $post->status = $request->input('status');
        $post->published_at = $request->input('published_at');
    
        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->file('featured_image')->store('public');
        }
    
        $post->save();
    
        return redirect()->route('admin.blog.index')->with([
            'message' => 'Entrada de blog actualizada con éxito.',
            'message_type' => 'warning',
        ]);
    }
    
    
    
    public function destroy($id)
    {
    $post = Post::findOrFail($id);
    $post->delete();

        return redirect()->route('admin.blog.index')->with([
            'message' => 'Entrada de blog eliminada con éxito.',
            'message_type' => 'danger',
        ]);
        
    }



    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.blog.show', compact('post'));
    }


    public function frontendShow(Post $post)
    {
        $post->increment('views');
        $categorias = CategoriaBlog::all();
        $mostViewedPosts = Post::where('status', 'publicado')->orderBy('views', 'desc')->take(5)->get();
        return view('frontend.blog.show', compact('post', 'categorias', 'mostViewedPosts'));
    }
    
    

    public function frontendIndex()
    {
        $posts = Post::where('status', 'publicado')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
    
        $categorias = CategoriaBlog::all();
        
        $mostViewedPosts = Post::where('status', 'publicado')
                               ->orderBy('views', 'desc')
                               ->take(5)
                               ->get();
    
        return view('frontend.blog.index', compact('posts', 'categorias', 'mostViewedPosts'));
    }
    

    
    
    public function deleteImage($id)
    {   
        $post = Post::findOrFail($id);

    
        if ($post->featured_image && file_exists(public_path($post->featured_image))) {
        unlink(public_path($post->featured_image));
    }

        $post->featured_image = null;
        $post->save();

        return redirect()->route('admin.blog.edit', $post->id)->with('success', 'La imagen ha sido borrada.');
    }

    public function recetas()
    {
        $posts = Post::where('categoria_id', 3)
                     ->where('status', 'publicado')
                     ->paginate(3);
    
        $mostViewedPosts = Post::orderBy('views', 'desc')
                               ->where('status', 'publicado')
                               ->take(5)
                               ->get();
    
        return view('frontend.recetas', ['posts' => $posts, 'mostViewedPosts' => $mostViewedPosts]);
    }
    

    public function novedades()
    {
        $posts = Post::where('categoria_id', 2)
                     ->where('status', 'publicado')
                     ->paginate(3);
    
        $mostViewedPosts = Post::orderBy('views', 'desc')
                               ->where('status', 'publicado')
                               ->take(5)
                               ->get();
    
        return view('frontend.novedades', ['posts' => $posts, 'mostViewedPosts' => $mostViewedPosts]);
    }
    

    public function noticias()
    {
        $posts = Post::where('categoria_id', 1)
                     ->where('status', 'publicado')
                     ->paginate(3);
    
        $mostViewedPosts = Post::orderBy('views', 'desc')
                               ->where('status', 'publicado')
                               ->take(5)
                               ->get();
    
        return view('frontend.noticias', ['posts' => $posts, 'mostViewedPosts' => $mostViewedPosts]);
    }
    
    
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        
       
        $posts = Post::where('title', 'LIKE', "%{$query}%")->get();
        
        $mostViewedPosts = Post::where('status', 'publicado')->orderBy('views', 'desc')->take(5)->get();

       
        return view('frontend.search-results', ['posts' => $posts, 'mostViewedPosts' => $mostViewedPosts]);
    }
    
}
