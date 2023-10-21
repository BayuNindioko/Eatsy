<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('categories')->get();

        foreach ($items as $item) {
            if (!empty($item->foto)) {
                $item->foto = asset('api/image/' . $item->foto);
            }
        }

        return response()->json($items);
    }

    public function detail($id)
    {
        $item = Item::with('categories')->findOrFail($id);

        if (!empty($item->foto)) {
            $item->foto = asset('api/image/' . $item->foto);
        }

        return response()->json($item);
    }
}
