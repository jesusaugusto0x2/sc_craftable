<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    
    /**
     * Show the form for editing logged user profile.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function editProfile(Request $request)
    {

        return view('user.profile.edit-profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @throws ValidationException
     * @return array|RedirectResponse|Redirector
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        // Validate the request
        $this->validate($request, [
            'name' => ['nullable', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($user->getKey(), $user->getKeyName()), 'string'], 
        ]);

        // Sanitize input
        $sanitized = $request->only([
            'name',
            'email',
        ]);

        // Update changed values user
        $user->update($sanitized);

        if ($request->ajax()) {
            \Session::flash('success', 'Perfil actualizado exitosamente');
            return ['redirect' => url('user/profile'), 'message' => 'Perfil actualizado exitosamente'];
        }

        return redirect('user/profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function editPassword(Request $request)
    {
        return view('user.profile.edit-password', [
            'user' => $request->user(),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @throws ValidationException
     * @return array|RedirectResponse|Redirector
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        // Validate the request
        $this->validate($request, [
            'password' => ['sometimes', 'confirmed', 'min:8', 'string'],
            
        ]);

        // Sanitize input
        $sanitized = $request->only([
            'password',
        ]);

        //Modify input, set hashed password
        $sanitized['password'] = bcrypt($sanitized['password']);

        // Update changed values AdminUser
        $user->update($sanitized);

        if ($request->ajax()) {
            \Session::flash('success', 'Contraseña actualizada exitosamente');
            return ['redirect' => url('user/password'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('user/password')->with('notification_success', 'Contraseña actualizada exitosamente');
    }
}
