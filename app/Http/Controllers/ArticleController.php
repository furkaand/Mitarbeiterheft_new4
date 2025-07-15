<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = Article::with('user')->orderBy('created_at', 'desc')->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content ?: null; // Set to null if empty
        $article->user_id = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            
            // Debug: Check if upload is working
            \Log::info('Image Upload Debug', [
                'has_file' => $request->hasFile('image'),
                'file_name' => $imageName,
                'file_size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'original_name' => $image->getClientOriginalName()
            ]);
            
            $imagePath = $image->storeAs('public/images', $imageName);
            $article->image = 'images/' . $imageName;
            
            \Log::info('Image stored at: ' . storage_path('app/public/images/' . $imageName));
        } else {
            \Log::info('No image file uploaded');
        }

        $article->save();

        return redirect()->route('articles.index')->with('success', 'Artikel wurde erfolgreich erstellt!');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        // Check if user can edit this article
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Sie haben keine Berechtigung, diesen Artikel zu bearbeiten.');
        }

        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Check if user can update this article
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Sie haben keine Berechtigung, diesen Artikel zu bearbeiten.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $article->title = $request->title;
        $article->content = $request->content ?: null; // Set to null if empty

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($article->image) {
                Storage::delete('public/' . $article->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/images', $imageName);
            $article->image = 'images/' . $imageName;
        }

        $article->save();

        return redirect()->route('articles.show', $article)->with('success', 'Artikel wurde erfolgreich aktualisiert!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        // Check if user can delete this article
        if (Auth::id() !== $article->user_id) {
            return redirect()->route('articles.index')->with('error', 'Sie haben keine Berechtigung, diesen Artikel zu löschen.');
        }

        // Delete image if exists
        if ($article->image) {
            Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel wurde erfolgreich gelöscht!');
    }

    /**
     * Display the specified image.
     */
    public function showImage($filename)
    {
        $path = storage_path('app/private/public/images/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    /**
     * Test upload method
     */
    public function testUpload(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('test-upload');
        }
        
        $result = [
            'has_file' => $request->hasFile('image'),
            'all_files' => $request->allFiles(),
            'post_data' => $request->except(['image']),
        ];
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $result['file_info'] = [
                'original_name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'mime_type' => $image->getMimeType(),
                'is_valid' => $image->isValid(),
                'error' => $image->getError(),
            ];
            
            // Try to store the file
            try {
                $imageName = 'test_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/images', $imageName);
                $result['upload_result'] = [
                    'success' => true,
                    'stored_path' => $imagePath,
                    'full_path' => storage_path('app/' . $imagePath),
                    'file_exists' => file_exists(storage_path('app/' . $imagePath)),
                ];
            } catch (\Exception $e) {
                $result['upload_result'] = [
                    'success' => false,
                    'error' => $e->getMessage(),
                ];
            }
        }
        
        return response()->json($result);
    }

    /**
     * Debug method to check articles
     */
    public function debug()
    {
        $articles = Article::all();
        $debug = [];
        
        foreach ($articles as $article) {
            $debug[] = [
                'id' => $article->id,
                'title' => $article->title,
                'image' => $article->image,
                'content' => $article->content,
                'content_length' => strlen($article->content ?? ''),
                'image_exists' => $article->image ? file_exists(storage_path('app/public/' . $article->image)) : false,
                'image_path' => $article->image ? storage_path('app/public/' . $article->image) : null,
            ];
        }
        
        return response()->json([
            'articles' => $debug,
            'php_settings' => [
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'post_max_size' => ini_get('post_max_size'),
                'max_file_uploads' => ini_get('max_file_uploads'),
                'memory_limit' => ini_get('memory_limit'),
            ],
            'storage_info' => [
                'images_dir_exists' => is_dir(storage_path('app/public/images')),
                'images_dir_writable' => is_writable(storage_path('app/public/images')),
                'public_link_exists' => is_link(public_path('storage')) || is_dir(public_path('storage')),
            ]
        ]);
    }
}
