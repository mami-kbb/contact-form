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
        $contact = new Contact($request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']));
        $contact->tel = $request->first_tel . $request->second_tel . $request->third_tel;

        $category = Category::find($contact['category_id']);
        $contact['category_name'] = $category ? $category->content : '';

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return redirect()->route('thanks');
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
