<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $countryList = Country::getAll();
        return view('user::index')->with('countryList', $countryList);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            $userId = Auth::id();
            $type = (int)$params['type'];
            if($type == 1) {
                User::where('id', (int)$userId)->update(['nation' => $params['country']]);
            } else if($type == 2){
                $validatedData = Validator::make($params, [
                    'email' => 'required|string|email|max:255|unique:users'
                ]);
                if ($validatedData->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validatedData->errors()
                    ], 200);
                }
                User::where('id', (int)$userId)->update(['email' => $params['email']]);
            } else if($type == 3){
                $validatedData = Validator::make($params, [
                    'passwordOld' => 'required|string|current_password',
                    'passwordNew' => 'required|string|min:6'
                ]);
                if ($validatedData->fails()) {
                    return response()->json([
                        'error' => true,
                        'message' => $validatedData->errors()
                    ], 200);
                }
                User::where('id', (int)$userId)->update(['password' => bcrypt($params['passwordNew'])]);
            }
        }

        $countryList = Country::getAll();
        return view('user::index')->with('countryList', $countryList);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function changeAvatar(Request $request)
    {
        if ($request->isMethod('post') && Auth::check()) {
            $params = $request->all();
            if ($request->hasFile('fileAvatar')) {
                $path = $request->file('fileAvatar')->store('avatar', ['disk' => 'public_image']);
                $arrPath = explode("/", $path);
                if ($path) {
                    $user = Auth::user();
                    $user->avatar = end($arrPath);
                    $user->save();
                }
                return response()->json(['error' => 0]);
            }
            return response()->json(['error' => 1]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
