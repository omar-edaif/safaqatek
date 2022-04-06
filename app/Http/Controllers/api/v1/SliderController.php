<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\api\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

/**
 * @group slider management
 *
 * APIs for managing sliders
 *
 */
class SliderController extends Controller
{
    /**
     * get sliders
     *
     * this route is called when to get sliders
     *
     * @authenticated
     * @urlParam lang The language. Example: en
     *
     */

    public function sliders()
    {
        $sliders =  Slider::whereActive(true)->get();
        return SliderResource::collection($sliders);
    }
}
