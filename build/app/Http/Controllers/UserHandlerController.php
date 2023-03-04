<?php

namespace App\Http\Controllers;

use App\Mail\AdminPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserHandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.user.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backoffice.pages.user.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('backoffice.pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $user->entity;
        if($user->entity) {
            $user->entity->entity;
        }
        return view('backoffice.pages.user.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editAccount(Request $request)
    {
        $userForm = Auth::user();
        return view('backoffice.pages.account.profile', compact('userForm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);
        $userForm = Auth::user();
        $userForm->update($request->all());
        return redirect()->route('account.info.edit')->with('success', 'Mise à jour avec succes.');
    }

    public function editPassword() {
        return view('backoffice.pages.account.reset-password');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|string',
            'cNewPassword' => 'required_with:newPassword|same:newPassword',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('account.password.edit')
                ->withInput($request->all())
                ->with('error', "Ancien mot de passe incorrecte");
        }

        if (Hash::check($request->oldPassword, $user->password)) {
            $user->password = bcrypt($request->newPassword);
            if(!$user->is_update_password) {
                $user->is_update_password = true;
            }
            $user->save();

            Auth::guard('web')->logout();
            return redirect()->route('login')
                    ->with('success', "Mot de passe mise à jour avec succès");
        }

        return redirect()->route('account.password.edit')
            ->withInput($request->all())
            ->with('error', "Ancien mot de passe incorrecte");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccountAccess(User $user)
    {
        $user->lock = !$user->lock;
        $user->save();
        return redirect()->back()->with('success', "Compte ". $user->lock ? "verrouillé" : "déverrouillé" ." avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetUserPassword(User $user)
    {
        //
        try {
            //code...
            $password=Str::random(7);
            $user->password = bcrypt($password);
            $user->save();
            // Mail::to($user)->send(new AdminPassword($user, $password, 0));
            return redirect()->route('users.show', $user)->with('success', 'Mot de passe mise à jour et envoyé par mail avec succès !!!'. " Le mot de passe est  $password");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('users.show', $user)->with('warning', "Mot de passe mise à jour avec succès. Mais l'envoie par mail a échoué. ");
        }
    }
}
