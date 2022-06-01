<?php

namespace App\Http\Controllers\dashbord;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function index(Request $request)
    {
        $sliders = Slider::paginate(5);
        return view('dashbord.sliders.index', compact('sliders'));
    }
    public function store(Request $request)
    {

        $this->validate($request, ['title' => 'required||string', 'image' => 'required||string']);

        return Slider::create([
            "title"   => $request->title,
            "image"   => str_replace('public', 'storage', Storage::putFile('public/images/sliders', $request->image)),
            "active"  => request('active') ? true : false,
        ]);

        return redirect()->route('dashbord.sliders.index')->with('created', __('the slider was created'));
    }

    public function edit($id)
    {
        $slider   =  Slider::findOrFail($id);

        return view('dashbord.sliders.edit', compact('slider'));
    }
    public function update(Request $request)
    {

        $slider = Slider::findOrFail($request->route('id'));
        $slider->title   = request('title');
        $slider->active  = $request->active ? true : false;
        if (request('image')) {

            $slider->image =   str_replace('public', 'storage', Storage::putFile('public/images/sliders', request('image')));
        }

        $slider->save();

        return redirect()->route('dashbord.sliders.index')->with('updated', __('the slider was updated'));
    }
    public function delete($id)
    {
        $slider  =  Slider::findOrFail($id);

        $slider->delete();

        return redirect()->route('dashbord.sliders.index')->with('deleted', __('the slider was deleted'));
    }
}
