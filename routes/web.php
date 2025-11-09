    <?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\CustomerController;
    use App\Http\Controllers\Client\AuthController;
    use App\Http\Controllers\Client\HomeController;
    use App\Http\Middleware\ClientAuth;
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

Route::prefix('client')->group(function () {
    // 🔹 Formulario para ingresar código (acceso libre)
    Route::get('/enter-code', [AuthController::class, 'showCodeForm'])->name('client.enterCode');
    Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('client.verifyCode');

    // 🔒 Rutas protegidas por sesión y sin caché
    Route::middleware([ClientAuth::class, 'no-cache'])->group(function () {
        // Formulario para registrar cuenta
        Route::get('/enter-account', [AuthController::class, 'showAccountForm'])->name('client.enterAccount');
        Route::post('/save-account', [AuthController::class, 'saveAccount'])->name('client.saveAccount');

        // Home del cliente
        Route::get('/home', [AuthController::class, 'home'])->name('client.home');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('client.logout');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');
    Route::post('/admin/register', [RegisteredUserController::class, 'storeAdmin'])
        ->name('admin.register.store');
});

    require __DIR__ . '/auth.php';
