<?php

// app/Http/Controllers/ImageController.php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        return view('user/upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $images = $request->file('images');
        $user_id = $request->session()->get('userId');
        foreach ($images as $image) {
            $fileName = $image->store('images', 'public');
            Image::create(['file_name' => $fileName,"user_id" =>$user_id]);
        }
        return response()->json(['message' => 'Images uploaded successfully.']);
 
    }   

    public function show()
    {
        $images = Image::all()->where('user_id',session('userId'));
        return view('/user/images', compact('images'));
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete($image->file_name);
        $image->delete();
        return redirect('/user/images')->with('success', 'Image deleted successfully.');
    }
}
