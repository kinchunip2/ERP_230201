<?php


namespace Modules\Setup\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Modules\Setup\Entities\City;
use Modules\Setup\Entities\State;

class SelectController extends Controller {

    public function state(Request $request) {
        $country = $request->value;
        return State::where('country_id', $country)->get();
    }

    public function city(Request $request) {
        $state = $request->value;
        return City::where('state_id', $state)->get();
    }

}
