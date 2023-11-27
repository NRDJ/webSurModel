<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\User\MainPageController;
use App\Http\Controllers\Admin\AdministrationController;
use App\Http\Controllers\User\PhotosController;
use App\Http\Controllers\Files\FileAccessController;
use App\Http\Controllers\ChangePasswordController;

Route::get('/', function () {
    return view('site.index');
})->name('index');

Route::get('/nosotros', function () {
    return view('site.about');
})->name('about');

Route::get('/trabajos', function () {
    return view('site.works');
})->name('works');

Route::get('/servicios', function () {
    return view('site.services');
})->name('services');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::user()->role->key == 'user') {
        return view('dashboard.home');
    }
    elseif (Auth::user()->role->key == 'admin') {
        return view('dashboard.admin.home');
    }

})->name('dashboard');

//actualizar perfil email y password 
Route::get('/settings/change-password', [ChangePasswordController::class, 'index'])->name('changePassword')->middleware(['auth']);

//Control Ruta de fotos o imagenes middleware auth
Route::get('/photos/{id}/{image}', [PhotosController::class, 'access'])->name('my-photo')->middleware(['auth']);
Route::get('/invoices/{id_publication}/{id_user}/{image}', [FileAccessController::class, 'accessHonoraryTicket'])->name('accessHonoraryTicket')->middleware(['auth']);
Route::get('/vouchers/{id_publication}/{id_user}/{image}', [FileAccessController::class, 'accessVoucher'])->name('accessVoucher')->middleware(['auth']);

//Dashboard Usuario middleware para usuario
Route::get('/dashboard/personal-information', [MainPageController::class, 'personalInformation'])->name('personal-information')->middleware(['auth']);
Route::get('/dashboard/photos/', [MainPageController::class, 'photos'])->name('photos')->middleware(['onlyUser']);
Route::get('/dashboard/applications/', [MainPageController::class, 'applications'])->name('applications')->middleware(['onlyUser']);


//Dashboard Administracion middleware para admin
Route::get('/dashboard/events', [AdministrationController::class, 'events'])->name('admin.events')->middleware(['onlyAdmin']);
Route::get('/dashboard/events/{slug}/publications', [AdministrationController::class, 'publications'])->name('admin.events.publications')->middleware(['onlyAdmin']);
Route::get('/dashboard/events/{slug}/publications/{id}', [AdministrationController::class, 'publication_detail'])->name('admin.events.publication-detail')->middleware(['onlyAdmin']);
Route::get('/dashboard/users/{person}/photos', [AdministrationController::class, 'photosUser'])->name('admin.users.photos')->middleware(['onlyAdmin']);
Route::get('/dashboard/users/{user}/settings/', [AdministrationController::class, 'settingsUser'])->name('admin.users.settings')->middleware(['onlyAdmin']);
Route::get('/dashboard/events/{slug}/publications/{id}/generate_pdf', [AdministrationController::class, 'generarPDF'])->name('admin.publication.generate-pdf')->middleware(['onlyAdmin']);
Route::get('/dashboard/profiles', [AdministrationController::class, 'profiles'])->name('admin.profiles')->middleware(['onlyAdmin']);
Route::get('/dashboard/sponsors', [AdministrationController::class, 'sponsors'])->name('admin.sponsors')->middleware(['onlyAdmin']);
Route::get('/dashboard/users', [AdministrationController::class, 'users'])->name('admin.users')->middleware(['onlyAdmin']);
Route::get('/dashboard/events/{slug}/publication/{publication}/user/{person}', [AdministrationController::class, 'invoice'])->name('admin.events.invoice')->middleware(['onlyAdmin']);

//Control Ruta de archivos middleware auth
//route for user voucher
Route::get('/dashboard/applications/{publication}/payment/{person}/voucher/{payment}',[MainPageController::class, 'verComprobante'])->name('user-voucher')->middleware(['auth']);

//routes from email middleware para usuario
Route::get('/dashboard/applications/{publication}/confirmation/{person}',[MainPageController::class, 'confirmarEvento'])->name('confirm-event')->middleware(['onlyUser']);
Route::get('/dashboard/applications/{publication}/payment/{person}',[MainPageController::class, 'confirmarDiasPago'])->name('days-payment')->middleware(['onlyUser']);

//control rutas publicas todos pueden ver
Route::get('/sponsors/{image}', [FileAccessController::class, 'imageSponsor'])->name('sponsor.image');
Route::get('/events/{image}', [FileAccessController::class, 'imageEvent'])->name('event.image');

//reset password all users
Route::get('/forget-password', [ChangePasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ChangePasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('/reset-password/{token}', [ChangePasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ChangePasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


//casting access temporal
Route::get('/casting/{slug}/{id}', [AdministrationController::class, 'temporalAccess'])->name('casting');
Route::get('/access/temporal/{id}/{image}', [FileAccessController::class, 'temporalAccessPhoto'])->name('access.temporal.photos');

//testing
// Route::get('/details', function () {

// 	$ip = \Request::ip();
//     $data = \Location::get($ip);
//     dd($ip);
   
// });