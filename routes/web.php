<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\AdminUserController;
use App\Models\Research;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin'      => redirect('/admin/dashboard'),
            'researcher' => redirect('/researcher/dashboard'),
            'reviewer'   => redirect('/reviewer/dashboard'),
            'guest'      => redirect('/guest/dashboard'),
            'user'       => redirect('/guest/dashboard'),
            default      => abort(403),
        };
    }

    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| ROLE SWITCH (TEST ONLY)
|--------------------------------------------------------------------------
*/
Route::get('/set-role/{role}', function ($role) {

    if (!in_array($role, ['admin', 'guest', 'researcher', 'reviewer'])) {
        abort(404);
    }

    $user = auth()->user();
    $user->role = $role;
    $user->save();

    return back();

})->middleware('auth');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD REDIRECT
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {

        return match (auth()->user()->role) {
            'admin'      => redirect('/admin/dashboard'),
            'researcher' => redirect('/researcher/dashboard'),
            'reviewer'   => redirect('/reviewer/dashboard'),
            'guest'      => redirect('/guest/dashboard'),
            'user'       => redirect('/guest/dashboard'),
            default      => abort(403),
        };

    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DASHBOARDS
    |--------------------------------------------------------------------------
    */
    Route::get('/guest/dashboard', fn() => view('guest.dashboard'))
        ->middleware('role:guest');

    Route::get('/researcher/dashboard', fn() => view('researcher.dashboard'))
        ->middleware('role:researcher');

    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))
        ->middleware('role:admin');


    /*
    |--------------------------------------------------------------------------
    | REVIEWER DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/reviewer/dashboard', function () {

        $pending  = Research::where('status', 'pending')->count();
        $approved = Research::where('status', 'approved')->count();
        $rejected = Research::where('status', 'rejected')->count();

        return view('reviewer.dashboard', compact('pending', 'approved', 'rejected'));

    })->middleware('role:reviewer');


    /*
    |--------------------------------------------------------------------------
    | RESEARCH ROUTES (CORE SYSTEM)
    |--------------------------------------------------------------------------
    */

    Route::get('/research/create', [ResearchController::class, 'create'])
        ->name('research.create')
        ->middleware('role:researcher');

    Route::post('/research', [ResearchController::class, 'store'])
        ->name('research.store')
        ->middleware('role:researcher');

    Route::get('/research/my', [ResearchController::class, 'myResearch'])
        ->name('research.my')
        ->middleware('role:researcher');

    Route::get('/research', [ResearchController::class, 'index'])
        ->name('research.index');

    Route::get('/research/{id}', [ResearchController::class, 'show'])
        ->name('research.show');

    Route::get('/research/{id}/edit', [ResearchController::class, 'edit'])
        ->name('research.edit')
        ->middleware('role:researcher');

    Route::put('/research/{id}', [ResearchController::class, 'update'])
        ->name('research.update')
        ->middleware('role:researcher');

    /*
    |--------------------------------------------------------------------------
    | DELETE RESEARCH — Admin OR Researcher (own only)
    |--------------------------------------------------------------------------
    */
    Route::delete('/research/{id}', [ResearchController::class, 'destroy'])
        ->name('research.destroy')
        ->middleware('role:admin,researcher'); // ✅ FIXED: was admin only


    /*
    |--------------------------------------------------------------------------
    | REVIEWER PANEL
    |--------------------------------------------------------------------------
    */

    Route::get('/reviewer/research', function () {

        $researches = Research::where('status', 'pending')
            ->latest()
            ->get();

        return view('reviewer.index', compact('researches'));

    })->name('reviewer.research')
      ->middleware('role:reviewer');


    Route::get('/reviewer/research/{id}', function ($id) {

        $research = Research::findOrFail($id);

        return view('research.show', compact('research'));

    })->name('reviewer.research.show')
      ->middleware('role:reviewer');


    /*
    |--------------------------------------------------------------------------
    | REVIEW ACTIONS
    |--------------------------------------------------------------------------
    */
    Route::post('/research/{id}/approve', function ($id) {

        $research = Research::findOrFail($id);
        $research->status  = 'approved';
        $research->remarks = request('remarks');
        $research->save();

        return back()->with('success', 'Research approved');

    })->name('research.approve')
      ->middleware('role:reviewer');


    Route::post('/research/{id}/reject', function ($id) {

        $research = Research::findOrFail($id);
        $research->status  = 'rejected';
        $research->remarks = request('remarks');
        $research->save();

        return back()->with('success', 'Research rejected');

    })->name('research.reject')
      ->middleware('role:reviewer');


    /*
    |--------------------------------------------------------------------------
    | ADMIN — USER MANAGEMENT
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users.index')
        ->middleware('role:admin');

    Route::patch('/admin/users/{id}/role', [AdminUserController::class, 'updateRole'])
        ->name('admin.users.updateRole')
        ->middleware('role:admin');

    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])
        ->name('admin.users.destroy')
        ->middleware('role:admin');


    /*
    |--------------------------------------------------------------------------
    | ROLE TOGGLE (TEST ONLY)
    |--------------------------------------------------------------------------
    */
    Route::post('/toggle-role', function () {

        $user = auth()->user();

        $roles = ['guest', 'researcher', 'reviewer', 'admin'];

        $current = array_search($user->role, $roles);
        $next    = ($current + 1) % count($roles);

        $user->role = $roles[$next];
        $user->save();

        return back()->with('success', 'Role switched to ' . $user->role);

    })->name('toggle.role');

});

require __DIR__.'/auth.php';