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
        return view('auth/login');
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
    Route::get('/enter-code', [AuthController::class, 'showCodeForm'])->name('client.enterCode');
    Route::post('/enter-code', [AuthController::class, 'verifyCode'])->name('client.verifyCode');

    // Rutas protegidas para clientes que ya ingresaron su código
    Route::middleware([ClientAuth::class])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('client.home');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');
    Route::post('/admin/register', [RegisteredUserController::class, 'storeAdmin'])
        ->name('admin.register.store');
});

    require __DIR__ . '/auth.php';
