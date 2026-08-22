<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Tag;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::paginate(7);
        $categories = Category::all();
        $tags = Tag::all();

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
