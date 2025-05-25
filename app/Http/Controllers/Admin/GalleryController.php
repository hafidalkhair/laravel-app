<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                
                // Log file information
                Log::info('Uploading image:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize()
                ]);

                // Generate filename
                $filename = time() . '_' . $image->getClientOriginalName();
                
                // Store the file
                $path = $image->storeAs('galleries', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image');
                }
                
                Log::info('Image stored successfully at: ' . $path);
                
                $validated['image'] = $filename;
            }

            $validated['is_featured'] = $request->has('is_featured');

            $gallery = Gallery::create($validated);

            Log::info('Gallery created successfully', ['gallery_id' => $gallery->id]);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery item created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create gallery: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload image. Please try again.');
        }
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                // Log file information
                $image = $request->file('image');
                Log::info('Updating image:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize()
                ]);

                // Delete old image
                if ($gallery->image) {
                    Storage::disk('public')->delete('galleries/' . $gallery->image);
                }

                // Generate filename
                $filename = time() . '_' . $image->getClientOriginalName();
                
                // Store the file
                $path = $image->storeAs('galleries', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image');
                }
                
                Log::info('Image updated successfully at: ' . $path);
                
                $validated['image'] = $filename;
            }

            $validated['is_featured'] = $request->has('is_featured');

            $gallery->update($validated);

            Log::info('Gallery updated successfully', ['gallery_id' => $gallery->id]);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery item updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update gallery: ' . $e->getMessage());
            return back()->with('error', 'Failed to update image. Please try again.');
        }
    }

    public function destroy(Gallery $gallery)
    {
        try {
            if ($gallery->image) {
                Storage::disk('public')->delete('galleries/' . $gallery->image);
            }

            $gallery->delete();

            Log::info('Gallery deleted successfully', ['gallery_id' => $gallery->id]);

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery item deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete gallery: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete gallery. Please try again.');
        }
    }
} 