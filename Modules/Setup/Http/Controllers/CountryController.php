<?php

namespace Modules\Setup\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Validation\ValidationException;
use Modules\Setup\Entities\Country;
use Modules\Setup\Http\Requests\CountryFormRequest;
use Modules\Setup\Repositories\CountryRepositoryInterface;

class CountryController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $models = Country::all();
        return view('setup::country.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('setup::country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request) {
        if (!$request->json()) {
            abort(404);
        }

        $validate_rules = [
            'name' => 'required|max:191|string|unique:countries,name',
            'code' => 'sometimes|nullable|max:10|string|unique:countries,code',
            'phonecode' => 'sometimes|nullable|max:10|string|unique:countries,phonecode',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        $model = new Country();
        $model->name = $request->name;
        $model->code = $request->code;
        $model->phonecode = $request->phonecode;
        $model->save();

        $response = [
            'model' => $model,
            'message' => __('setup.Country Added Successfully'),
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
    public function show($id) {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $model = Country::findOrFail($id);
        return view('setup::country.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id) {
        if (!$request->json()) {
            abort(404);
        }

        $validate_rules =  [
            'name' => 'required|max:191|string|unique:countries,name,'.$id,
            'code' => 'sometimes|nullable|max:10|string|unique:countries,code,'.$id,
            'phonecode' => 'sometimes|nullable|max:10|string|unique:countries,phonecode,'.$id,
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        $model = Country::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setup.Country Not Found')]);
        }

        $model->name = $request->name;
        $model->code = $request->code;
        $model->phonecode = $request->phonecode;
        $model->save();

        $response = [
            'message' => __('setup.Country Updated Successfully'),
            'goto' => route('setup.country.index'),
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
    public function destroy(Request $request, $id) {

        $model = Country::find($id);
        if (!$model) {
            throw ValidationException::withMessages(['message' => __('setup.Country Not Found')]);
        }

        if ($model->states) {
            throw ValidationException::withMessages(['message' => __('setup.Country Has States. For delete country, first delete states')]);
        }

        $model->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => __('setup.Country Deleted Successfully'), 'goto' => route('setup.country.index')]);
        }
        Toastr::success(__('setup.Country Deleted Successfully'), __('common.Success'));
        return redirect()->back();


    }
}
