<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|---------------------------------
| ROLE SWITCH (TEMPORARY FOR TESTING)
|---------------------------------
*/
Route::get('/set-role/{role}', function ($role) {

    if (!in_array($role, ['admin', 'user'])) {
        abort(404);
    }

    $user = auth()->user();
    $user->role = $role;
    $user->save();

    return back();

})->middleware('auth');

/*
|---------------------------------
| AUTH PROTECTED ROUTES
|---------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('research', ResearchController::class);

    // Toggle role button
    Route::post('/toggle-role', function () {

        $user = auth()->user();

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Role switched successfully!');

    })->name('toggle.role');

});

require __DIR__.'/auth.php';