<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
    // View File To Upload Image
    public function index()
    {
        return view('image-form');
    }

    // Store Image
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        //原本機開發環境使用↓
        // $imageName = time().'.'.$request->image->extension();

        // // Public Folder
        // $request->image->move(public_path('images'), $imageName);

        // return back()
        // ->with('success', 'Image uploaded Successfully!')
        // ->with('image', $imageName);
        //原本機開發環境使用↑

        // 上傳到雲端，但不急著存入 User 表
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'previews', // 放在預覽資料夾
        ])->getSecurePath();

        // 傳回 URL，讓前端的 AJAX 或是頁面顯示這張雲端圖片
        return back()
            ->with('success', '預覽圖已生成')
            ->with('image', $uploadedFileUrl);

    }
}
