<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));

    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();

        $category = Category::find($contact['category_id']);
        $contact['category_name'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->all();
        Contact::create($contact);

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function export()
{
    return response()->download(storage_path('app/contacts.csv'));
}

}
