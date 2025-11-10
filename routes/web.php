    <?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\CustomerController;
    use App\Http\Controllers\Client\AuthController;
    use App\Http\Middleware\ClientAuth;
    use App\Http\Controllers\AdminController;

    use App\Http\Controllers\Auth\RegisteredUserController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('client/enter-code');
    });

    

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('customers', CustomerController::class);

        Route::get('/customers/{id}/show-code', [CustomerController::class, 'showCode'])
            ->name('customers.showCode');

        
            
            Route::patch('/customers/{customer}/actives', [CustomerController::class, 'actives'])
        ->name('customers.actives');


    Route::prefix('client')->group(function () {
        // Acceso libre
        Route::get('/enter-code', [AuthController::class, 'showCodeForm'])->name('client.enterCode');
        Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('client.verifyCode');

        // Rutas protegidas por sesión
        Route::middleware([ClientAuth::class, 'no-cache'])->group(function () {
            Route::get('/enter-account', [AuthController::class, 'showAccountForm'])->name('client.enterAccount');
            Route::post('/save-account', [AuthController::class, 'saveAccount'])->name('client.saveAccount');
            Route::get('/home', [AuthController::class, 'home'])->name('client.home');
            Route::post('/logout', [AuthController::class, 'logout'])->name('client.logout');
        });

        // Logout que va a login (SIN middleware ClientAuth)
        Route::post('/logouts', [AuthController::class, 'logouts'])->name('client.logouts');
    });

    Route::get('/api/new-accounts', [AdminController::class, 'checkNewAccounts'])
        ->name('admin.checkNewAccounts');


    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/register', [RegisteredUserController::class, 'create'])
            ->name('admin.register');
        Route::post('/admin/register', [RegisteredUserController::class, 'storeAdmin'])
            ->name('admin.register.store');
    });



    require __DIR__ . '/auth.php';
