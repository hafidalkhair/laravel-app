<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.form');
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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/galleries', $filename);
            $validated['image'] = $filename;
        }

        $validated['is_featured'] = $request->has('is_featured');

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item created successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.form', compact('gallery'));
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

        if ($request->hasFile('image')) {
            // Delete old image
            if ($gallery->image) {
                Storage::delete('public/galleries/' . $gallery->image);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/galleries', $filename);
            $validated['image'] = $filename;
        }

        $validated['is_featured'] = $request->has('is_featured');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::delete('public/galleries/' . $gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery item deleted successfully.');
    }
} 