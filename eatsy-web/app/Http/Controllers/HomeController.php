<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends Controller
{
    public function index($id)
    {
        $tableIdInSession = Session::get('table_id');
        if (!$tableIdInSession || $tableIdInSession !== $id) {
            return redirect()->route('register/', ['id' => $id])->with('error', 'You are not authorized to access this table.');
        }

        $response = Http::get('https://lamaisonetc.my.id/api/items');
        $data = $response->json();

        $responseCategory = Http::get('https://lamaisonetc.my.id/api/categories');
        $dataCategory = $responseCategory->json();

        $responseTable = Http::get('https://lamaisonetc.my.id/api/tables/' . $id . '/reservations');
        $dataTable = $responseTable->json();

        return view('homepage.homepage', [
            'data' => $data,
            'dataCategory' => $dataCategory,
            'dataTable' => $dataTable
        ]);
    }

    public function do_tambah_cart($id, Request $request)
    {
        $response = Http::get("https://lamaisonetc.my.id/api/items/{$id}");
        $item = $response->json();

        $table_id = $request->input('table_id');

        $responseTable = Http::get('https://lamaisonetc.my.id/api/tables/' . $table_id . '/reservations');
        $dataTable = $responseTable->json();

        if (!$item) {
            return redirect()->route('homepage')->with('error', 'Item not found.');
        }

        $cartItems = Session::get('cartItems', []);
        $existingCartItem = null;

        foreach ($cartItems as $index => $cartItem) {
            if ($cartItem['id'] == $item['id']) {
                $existingCartItem = $cartItem;
                break;
            }
        }

        $qty = (int)$request->input('qty');
        $catatan = $request->input('catatan');

        if ($existingCartItem) {
            $existingCartItem['qty'] += $qty;
            $existingCartItem['catatan'] = $catatan;
        } else {
            $item['qty'] = $qty;
            $item['catatan'] = $catatan;
            $cartItems[] = $item;
        }

        Session::put('cartItems', $cartItems);

        return redirect()->to('homepage/' . $dataTable['table_id'])->with('success', 'Item added to cart.');
    }

    public function removeFromCart($id)
    {
        $cartItems = Session::get('cartItems', []);
        $updatedCartItems = [];

        foreach ($cartItems as $cartItem) {
            if ($cartItem['id'] != $id) {
                $updatedCartItems[] = $cartItem;
            }
        }

        Session::put('cartItems', $updatedCartItems);

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    public function submitOrder(Request $request)
    {
        $tableIdInSession = Session::get('table_id');
        $responseTable = Http::get('https://lamaisonetc.my.id/api/tables/' . $tableIdInSession . '/reservations');
        $dataTable = $responseTable->json();

        $reservationSession = $dataTable['id'];

        $cartItems = Session::get('cartItems', []);

        $orderData = [
            'reservation_id' => $reservationSession,
            'items' => []
        ];

        foreach ($cartItems as $item) {
            $orderData['items'][] = [
                'item_id' => $item['id'],
                'quantity_order' => $item['qty'],
                'price' => $item['price'],
                'name' => $item['name'],
                'notes' => $item['catatan'],
            ];
        }

        $response = Http::post('https://lamaisonetc.my.id/api/order/store', $orderData);

        if ($response->successful()) {
            Session::forget('cartItems');

            // Redirect to the homepage with the correct table ID
            return redirect()->route('homepage/', ['id' => $tableIdInSession])->with('success', 'Order submitted successfully.');
        }
    }
}
