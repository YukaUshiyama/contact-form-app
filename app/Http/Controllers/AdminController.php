<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\IndexContactRequest;

class AdminController extends Controller
{
    public function index(IndexContactRequest $request)
{
    $categories = Category::all();
    $tags = Tag::all();

    $keyword = $request->query('keyword');
    $gender = $request->query('gender');
    $categoryId = $request->query('category_id');
    $date = $request->query('date');

    $query = Contact::query();

    if ($keyword) {
        $query->where(function ($query) use ($keyword) {
            $query->where('first_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                  ->orWhere('email', 'LIKE', "%{$keyword}%");
        });
    }

    if ($gender !== null && $gender != 0) {
        $query->where('gender', $gender);
    }

    if ($categoryId !== null) {
        $query->where('category_id', $categoryId);
    }

    if ($date) {
        $query->whereDate('created_at', $date);
    }

    $contacts = $query->paginate(7);

    return view('admin.index', [
        'user' => $request->user(),
        'contacts' => $contacts,
        'categories' => $categories,
        'tags' => $tags,
    ]);
}
    public function show(Contact $contact)
{
    return view('admin.show', compact('contact'));
}
public function destroy(Contact $contact)
{
    $contact->delete();

    return redirect('/admin');
}
}
