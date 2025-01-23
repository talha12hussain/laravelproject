<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\localeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AgentForgetPasswordController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\pdfController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;

use App\Http\Controllers\NewPropertyController;
use App\Http\Controllers\PropertyRecordController;
use App\Http\Controllers\RealEstateController;
use App\Http\Controllers\PropertyNewFormController;
use App\Http\Controllers\MapController;


Route::get('/map', function () {
    return view('map'); 
});

Route::get('/admin-property/properties/{id}/print', [PropertyNewFormController::class, 'printProperty'])->name('properties.print');

Route::get('/admin-property', [PropertyNewFormController::class, 'show'])->name('admin.dashboard.propertyTable');
Route::get('/admin-property/export', [PropertyNewFormController::class, 'export'])->name('admin.property.export');
Route::put('/admin-property/{id}', [PropertyNewFormController::class, 'update'])->name('properties.update');
Route::post('/realestate/store', [PropertyNewFormController::class, 'store'])->name('realestate.store');
Route::delete('/admin-property/{id}', [PropertyNewFormController::class, 'destroy'])->name('properties.destroy');




Route::get('test-email', function(){
    Mail::raw('this is a test email', function($message){
        $message->to('sardary015@gmail.com')->subject('Test Email');
    });
});









// Route::get('/', [HomeController::class,'index'])->name('front.home');
Route::get('about', [HomeController::class,'about'])->name('front.about');
Route::get('privacy-policy', [HomeController::class,'privacy'])->name('front.privacy');
Route::get('terms-and-conditions', [HomeController::class,'terms'])->name('front.terms');
Route::get('contact-us', [HomeController::class,'contact'])->name('front.contact');


// Route::get('/linkstorage', function () {
//     $targetFolder = storage_path('app/public'); // Target directory
//     $linkFolder = public_path('storage');       // Symlink location

//     // Check if the symbolic link or directory exists and remove it
//     if (is_link($linkFolder) || file_exists($linkFolder)) {
//         // Remove existing symbolic link or directory
//         if (is_link($linkFolder)) {
//             // It's a symlink, so unlink it
//             unlink($linkFolder);
//         } else {
//             // It's a directory or file, so remove it
//             File::deleteDirectory($linkFolder);
//         }
//     }

//     // Create the symbolic link
//     if (symlink($targetFolder, $linkFolder)) {
//         return 'Storage link has been created successfully.';
//     } else {
//         return 'Failed to create the storage link.';
//     }
// });


// Route::get('/relinkstorage', function () {
//     $linkFolder = public_path('storage');

//     // Remove the existing symbolic link if it exists
//     if (file_exists($linkFolder)) {
//         unlink($linkFolder);
//     }

//     // Create a new symbolic link
//     $targetFolder = storage_path('app/public');
//     symlink($targetFolder, $linkFolder);

//     if (file_exists($linkFolder)) {
//         return 'Storage link has been recreated successfully.';
//     } else {
//         return 'Failed to create the storage link.';
//     }
// });

Route::middleware('role:admin')->group(function () {
    Route::get('admin/profile', [ProductController::class, 'adminProfile'])->name('admin.profile');
    Route::get('agent-request', [ProductController::class, 'agentRequest'])->name('admin.dashboard.agentRequest');
    Route::get('agent-list', [ProductController::class, 'agentList'])->name('admin.dashboard.agentList');
    Route::get('property/excel-export/', [ProductController::class, 'export'])->name('property.export');
    Route::get('property/export/pdf/{id}', [PdfController::class, 'PDFexport'])->name('property.export.pdf');
    Route::get('dashboard', [AdminController::class, 'dashboardCheck'])->name('admin.adminMain');
    Route::get('admin/home', [AdminController::class, 'home'])->name('admin.dashboard.home');
    Route::get('create-property', [ProductController::class, 'createPropertyForm'])->name('admin.dashboard.createProperty');
    Route::get('store-property', [ProductController::class, 'storePropertyForm'])->name('admin.dashboard.storeProperty');
    Route::post('store-property', [ProductController::class, 'storePropertyForm'])->name('admin.dashboard.storeProperty');
    Route::get('agent-export', [AgentController::class, 'export'])->name('agent.export');
    Route::get('agent/property-export/{agentId}', [AgentController::class, 'agentPropertyExport']);
    Route::delete('/agent-request/{id}/delete', [ProductController::class, 'destroyAgent']);
    Route::post('/toggle-agent-status/{agentId}', [ProductController::class, 'agentStatus'])->name('toggle.agent.status');
    Route::get('/toggle-agent-status/{agentId}', [ProductController::class, 'agentStatus'])->name('admin.agent-login.login');
    Route::get('edit-property/{id}', [ProductController::class, 'editPropertyForm'])->name('admin.dashboard.editProperty');
    Route::get('show-property/{id}', [ProductController::class, 'showProperty'])->name('admin.dashboard.showProperty');
    Route::put('update-property/{id}', [ProductController::class, 'updatePropertyForm'])->name('admin.dashboard.updateProperty');
    Route::delete('/property/{id}/delete', [ProductController::class, 'destroy']);
    Route::post('property/{id}/delete-floor', [ProductController::class, 'floorDelete'])->name('admin.floor.editdelete');
    Route::delete('/admin/edit-image/delete/{id}', [ProductController::class, 'deleteEditImage'])->name('admin.edit.image.delete');
});

Route::middleware('role:agent')->group(function () {
    Route::get('agent/properties-list', [AgentController::class, 'agentProperty'])->name('agent.dashboard.agentPropertyTable');
    Route::get('agent/create-property', [AgentController::class, 'agentPropertyForm'])->name('admin.dashboard.agentCreateProperty');
    Route::get('agent/store-property', [AgentController::class, 'storePropertyForm'])->name('agent.storeProperty');
    Route::post('agent/store-property', [AgentController::class, 'storePropertyForm'])->name('agent.storeProperty');
    Route::get('agent/edit-property/{id}', [AgentController::class, 'editPropertyForm'])->name('agent.dashboard.agentEdit');
    Route::get('agent-show-property/{id}', [AgentController::class, 'agentShowProperty'])->name('agent.dashboard.showProperty');
    Route::put('agent/update-property/{id}', [AgentController::class, 'updatePropertyForm'])->name('agent.dashboard.updateProperty');
    Route::get('agent/home', [AgentController::class, 'agentHome'])->name('admin.dashboard.agentHome');
    Route::get('agent/profile', [AgentController::class, 'agentProfile'])->name('agent.profile');
});



Route::get('/', [HomeController::class, 'showHome'])->name('home');
// Route::get('/properties', [HomeController::class, 'showHomeAll'])->name('front.properties');

Route::get('properties', [HomeController::class,'properties'])->name('front.properties');
Route::get('properties/filter', [HomeController::class,'filterByCity'])->name('front.properties.filter');
Route::get('single-property/{id}', [HomeController::class,'singleProperty'] )->name('front.single-property');
Route::get('single-property/{id}/floor/{floorId}', [HomeController::class,'singlefloor'] )->name('front.single-floor');
Route::post('contact-us-save', [HomeController::class, 'contactUsSave'])->name('front.contactUsSave');




Route::view('login', 'admin/login/login' )->name('admin.login.login');
Route::post('loginMatch', [AdminController::class, 'login'])->name('loginMatch');

Route::post('logout', [AdminController::class, 'logout'])->name('logout');
Route::post('agent-store',[agentController::class,'storeAgent'])->name('agent.store');


Route::get('locale/{lang}', [localeController::class,'setLocale']);
Route::get('agent/locale/{lang}', [localeController::class,'setLocale']);
Route::get('admin/locale/{lang}', [localeController::class,'setLocale']);

Route::post('agentloginMatch', [agentController::class, 'agentlogin'])->name('agentLoginMatch');


Route::view('agent-register', 'admin/agent-login/register' )->name('admin.agent-login.register');
Route::view('agent-login', 'admin/agent-login/login' )->name('admin.agent-login.login');



Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('agent-forget-password', [AgentForgetPasswordController::class, 'showForgetPasswordForm'])->name('agentforget.password.get');
Route::post('agent-forget-password', [AgentForgetPasswordController::class, 'submitForgetPasswordForm'])->name('agentforget.password.post'); 
Route::get('agent-reset-password/{token}', [AgentForgetPasswordController::class, 'showResetPasswordForm'])->name('agentreset.password.get');
Route::post('agent-reset-password', [AgentForgetPasswordController::class, 'submitResetPasswordForm'])->name('agentreset.password.post');


Route::view('/sign-up', 'admin/login/sign-up')->name('admin.login.sign-up');
Route::post('registerSave', [AdminController::class,'register'])->name('registerSave');









