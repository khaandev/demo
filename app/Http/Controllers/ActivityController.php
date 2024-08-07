<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $activity = $user->activity();
        return view('pages.activity', compact('user', 'activity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Peshawar', 'Quetta', 'Multan', 'Sialkot', 'Gujranwala'];
        return view('pages.addActivity', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        $user = Auth::user();
        if ($user->activity) {
            return redirect()->route('activites.index')->with('error', 'You Already Create Actvivty !');
        }

        $imagesPath = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('activites', 'public');
                $imagesPath[] = $path;
            }
        }

        $user->activity()->create([
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'images' => json_encode($imagesPath),
        ]);

        return redirect()->route('activites.index')->with('success', 'Activity Created Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $cities = ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Faisalabad', 'Peshawar', 'Quetta', 'Multan', 'Sialkot', 'Gujranwala'];
        $user = Auth::user();
        $activity = Activity::findOrFail($user->activity->id);
        return view('pages.updateActivity', compact('cities', 'activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        $user = Auth::user();
        $activity = Activity::findOrFail($user->activity->id);
        $imagesPath = [];

        $data = [
            'name' => $request->input('name'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
        ];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $imagesPath[] = $path;
            }
            $data['images'] = json_encode($imagesPath);
        } else {
            unset($data['images']);
        }
        $activity->update($data);

        return redirect()->route('activites.index')->with('success', 'Activity Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $user = Auth::user();
        $activity = Activity::findOrFail($user->activity->id);
        $activity->delete();
        return redirect()->route('activites.index')->with('success', 'Activity Delete Successfully !');

    }
}
