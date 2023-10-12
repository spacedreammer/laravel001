<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingControler extends Controller
{
    //show all listing
    public function index()
    {
        //dd(request('tag'));
        return View('listing.index', [
            // 'listings' => Listing::all()
            // filter
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)


        ]);
    }

    //show single listing
    public function show(Listing $listing)
    {
        return view('listing.show', [
            'listing' => $listing
        ]);
    }

    public function create()
    {
        return view('listing.create');
    }


    public function store(Request $request)
    {
        // dd($request->file('logo'));
        $formFields = $request->validate(
            [
                'title' => 'required',
                'company' => ['required', Rule::unique('listings', 'company')],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //This is to know which user created the list
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        // one.way or like below //Session()::flash('meaasge','List Created Successful');

        return redirect('/')->with('message', 'List Created Successful');
    }




    //show Edit Form

    public function edit(Listing $listing)
    {
        // dd($listing->title);
        return view('listing.edit', ['listing' => $listing]);
    }

    //update form

    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate(
            [
                'title' => 'required',
                'company' => ['required'],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $listing->update($formFields);

        // one.way or like below //Session()::flash('meaasge','List Created Successful');

        return back()->with('message', 'List Updated Successful');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'list deleted successfully');
    }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
