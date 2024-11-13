<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishListRequest;
use App\Http\Requests\ContactUsRequest;
use App\Http\Resources\WishList\WishListCollection;
use App\Http\Resources\WishList\WishListResource;
use App\Models\CartItem;
use App\Models\ContactUsMessage;
use App\Models\WishList;
use App\Services\Response\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    public function store(ContactUsRequest $request)
    {
        $item = ContactUsMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        if(!$item) return ResponseService::jsonError("failed to send");
        return ResponseService::jsonSuccess("message sent successfully");
    }

}
