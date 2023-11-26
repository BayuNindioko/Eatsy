<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('categories')->get();

        foreach ($items as $item) {
            if (!empty($item->foto)) {
                $item->foto = asset('../storage/app/image/' . $item->foto);
            }
        }

        return response()->json($items);
    }

    public function detail($id)
    {
        $item = Item::with('categories')->findOrFail($id);

        if (!empty($item->foto)) {
            $item->foto = asset('../storage/app/image/' . $item->foto);
        }

        return response()->json($item);
    }

    public function store(Request $request)
    {
        $image = null;

        if ($request->file) {
            $fileName = Str::random(20);;
            $extension = $request->file->extension();
            $image = $fileName . '.' . $extension;
            Storage::putFileAs('image', $request->file, $image);
        }

        $request['foto'] = $image;
        $item = Item::create($request->except('category_ids'));

        if ($request->category_ids) {
            $item->categories()->attach($request->category_ids);
        }

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->update($request->except('foto', 'category_ids'));

        if ($request->hasFile('foto')) {
            Storage::delete('images' . $item->foto);

            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension();
            $foto->move('images', $fotoName);
            $item->foto = $fotoName;

            $item->save();
        }

        if ($request->has('category_ids')) {
            $item->categories()->sync($request->category_ids);
        }

        return response()->json($item);
    }


    public function delete($id)
    {
        $item = Item::findOrFail($id)->delete();

        return response()->json($item);
    }
}
