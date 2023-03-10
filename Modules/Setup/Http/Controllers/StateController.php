<?php


namespace Modules\Setup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Modules\Setup\Entities\Country;
use Modules\Setup\Entities\State;


class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $countries = Country::all()->pluck('name', 'id');
        $country_id = request()->country_id;
        if (!$country_id){
            $country_id = array_key_first($countries->toArray());
        }
        $models = State::where('country_id', $country_id)->get();
        $countries = $countries->prepend(__('contact.Select Country'), '');

        return view('setup::state.index', compact('models', 'countries', 'country_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $country_id = request()->country_id;
        $countries = Country::all()->pluck('name', 'id');
        if (!$country_id) {
            $country_id = array_key_first($countries->toArray());
        }
        $countries = $countries->prepend(__('contact.Select Country'), '');
        return view('setup::state.create', compact('countries', 'country_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        if (!$request->json()) {
            abort(404);
        }

        $validate_rules = [
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'name' => 'required|max:191|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        $model = new State();
        $model->name = $request->name;
        $model->country_id = $request->country_id;
        $model->save();

        $response = [
            'model' => $model,
            'message' => __('setup.State Added Successfully'),
            'reload' => true
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = State::findOrFail($id);
        return view('setup::state.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $model = State::findOrFail($id);
        $countries = Country::all()->pluck('name', 'id')->prepend(__('contact.Select Country'), '');
        return view('setup::state.edit', compact('model', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        if (!$request->json()) {
            abort(404);
        }

        $validate_rules = [
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'name' => 'required|max:191|string',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));


        $model = State::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setup.State Not Found')]);
        }

        $model->name = $request->name;
        $model->country_id = $request->country_id;
        $model->save();

        $response = [
            'message' => __('setup.State Updated Successfully'),
            'goto' => route('setup.state.index', ['country_id' => $model->country_id]),
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     * @throws ValidationException
     */
    public function destroy(Request $request, $id)
    {
        if (!$request->json()) {
            abort(404);
        }

        $model = State::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setup.State Not Found')]);
        }

        if ($model->cities) {
            throw ValidationException::withMessages(['message' => __('setup.State Has Cities. For delete state, first delete city')]);
        }

        $model->delete();

        return response()->json(['message' => __('setup.State Deleted Successfully'), 'goto' => route('setup.state.index')]);
    }
}
