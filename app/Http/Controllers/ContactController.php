<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('contact.index', compact('categories'));
    }
    public function confirm(StoreContactRequest $request)
{
    $validated = $request -> validated();
    $category = Category::find($validated['category_id']);
        return view('contact.confirm',compact('validated','category'));
}
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        $contact = Contact::create([
            'category_id' => $validated['category_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'tel' => $validated['tel'],
            'address' => $validated['address'],
            'building' => $validated['building'] ?? null,
            'detail' => $validated['detail'],
        ]);
        if (!empty($validated['tag_ids'])) {
        $contact->tags()->attach($validated['tag_ids']);
    }
        return redirect('/thanks');
    }
    public function thanks()
{
    return view('contact.thanks');
}
}