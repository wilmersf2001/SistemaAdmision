<?php

use App\Http\Controllers\Admision\AuthController;
use App\Http\Controllers\Admision\HomeController;
use App\Http\Controllers\Inscripcion\FichaInscripcionController;
use App\Http\Controllers\Admision\UserController;
use App\Http\Controllers\Inscripcion\ApplicantController;
use App\Http\Controllers\Inscripcion\PayController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Auth
Route::get("/login", [AuthController::class, "showLoginForm"])->name('login');
Route::post("/login", [AuthController::class, "authenticate"]);

Route::group(['middleware' => 'auth'], function () {

	Route::get("home", HomeController::class)->name('home');
	Route::get("archivos-validos", [HomeController::class, "validPhotos"])->name('applicant-photo.validPhotos');
	Route::get("archivos-observados", [HomeController::class, "observedPhotos"])->name('applicant-photo.observedPhotos');
	Route::get("archivos-rectificar", [HomeController::class, "rectifyPhotos"])->name('applicant-photo.rectifyphotos');
	Route::get("archivos-rectificados-validos", [HomeController::class, "validRectifiedPhotos"])->name('applicant-photo.validRectifiedPhotos');


	Route::get("ficha-inscripcion", [HomeController::class, "inscriptionComprobant"])->name('home.inscriptionComprobant');
	Route::get("modificar-postulante", [HomeController::class, "modifyApplicant"])->name('home.modifyApplicant');


	Route::group(['middleware' => 'role:admin'], function () {
		Route::get("usuarios", [HomeController::class, "user"])->name('home.user');
		Route::post('user-store', [UserController::class, 'store'])->name('user.store');
		Route::put("user-assign-permission/{user}", [UserController::class, "assignPermission"])->name('user.assignPermission');
		Route::delete("user-destroy/{user}", [UserController::class, "destroy"])->name('user.destroy');
		Route::get("apertura-proceso", [HomeController::class, "processOpening"])->name('home.processOpening');
		/* Route::post("open-process", [ProcessController::class, "store"])->name('process.store');
		Route::put("update-process/{process}", [ProcessController::class, "update"])->name('process.update');
		Route::delete("process-destroy/{process}", [ProcessController::class, "destroy"])->name('process.destroy'); */
		//RUTAS DISTRIBUTION VACANTES
		Route::get("asignar-vacantes", [HomeController::class, "assignVacancies"])->name('home.assignVacancies');
		Route::get("distribucion-vacantes", [HomeController::class, "vacancyDistribution"])->name('home.vacancyDistribution');
		/* Route::post("store", [VacancyDistributionController::class, "store"])->name('vacancyDistribution.store'); */
		//RUTAS SUBIR ARCHIVO TXT
		Route::get("subir-archivo-txt", [HomeController::class, "uploadTxtFile"])->name('home.uploadTxtFile');
		Route::get("archivos-txt", [HomeController::class, "uploadedFiles"])->name('home.uploadedFiles');
		/* Route::post("store-txt-file", [FileTxtController::class, "store"])->name('fileTxt.store'); */
	});


	Route::post('/logout', [AuthController::class, "logout"])->name('auth.logout');

	Route::get("apertura-proceso", [HomeController::class, "processOpening"])->name('home.processOpening');

	/* Route::group(['middleware' => 'role:admin|validatePhotos'], function () {
		Route::post("send-email", [MailController::class, "sendMail"])->name('mail.sendMail');
	}); */

	/* Route::group(['middleware' => 'role:admin|modify'], function () {
		Route::put("update-applicant/{applicant}", [ApplicantController::class, "update"])->name('applicant.update');
		Route::get("ficha-inscripcion/{dni}", [PdfController::class, "pdfData"])->name('pdf.pdfData');
	});

	Route::group(['middleware' => 'role:admin'], function () {
		Route::get("usuarios", [HomeController::class, "user"])->name('home.user');
		Route::post('user-store', [UserController::class, 'store'])->name('user.store');
		Route::put("user-assign-permission/{user}", [UserController::class, "assignPermission"])->name('user.assignPermission');
		Route::delete("user-destroy/{user}", [UserController::class, "destroy"])->name('user.destroy');
		Route::get("apertura-proceso", [HomeController::class, "processOpening"])->name('home.processOpening');
		Route::post("open-process", [ProcessController::class, "store"])->name('process.store');
		Route::put("update-process/{process}", [ProcessController::class, "update"])->name('process.update');
		Route::delete("process-destroy/{process}", [ProcessController::class, "destroy"])->name('process.destroy');
		//RUTAS DISTRIBUTION VACANTES
		Route::get("asignar-vacantes", [HomeController::class, "assignVacancies"])->name('home.assignVacancies');
		Route::get("distribucion-vacantes", [HomeController::class, "vacancyDistribution"])->name('home.vacancyDistribution');
		Route::post("store", [VacancyDistributionController::class, "store"])->name('vacancyDistribution.store');
		//RUTAS SUBIR ARCHIVO TXT
		Route::get("subir-archivo-txt", [HomeController::class, "uploadTxtFile"])->name('home.uploadTxtFile');
		Route::get("archivos-txt", [HomeController::class, "uploadedFiles"])->name('home.uploadedFiles');
		Route::post("store-txt-file", [FileTxtController::class, "store"])->name('fileTxt.store');
	});

	Route::get('/restringido', [HomeController::class, "restricted"])->name('restricted');
	Route::any('/{any}', [HomeController::class, "PageNotFound"])->where('any', '.*'); */
});

// Registro de postulante
Route::get('/', PayController::class)->name('start');
Route::post('/registro-postulante', [PayController::class, "validatePayment"])->name('pay.validatePayment');
Route::post('/store', [ApplicantController::class, "store"])->name('applicant.store');
Route::get('/mensaje', [ApplicantController::class, "finalMessage"])->name('applicant.finalMessage');
// Ficha de inscripción
Route::get('/ficha-inscripcion', FichaInscripcionController::class)->name('ficha.startPdfQuery');
Route::post('/ficha-inscripcion', [FichaInscripcionController::class, "validatePdf"])->name('ficha.validatePdf');
Route::post('/rectificar-foto', [FichaInscripcionController::class, "storeRectifiedPhotos"])->name('ficha.storeRectifiedPhotos');

Route::any('/{any}', function () {
	return view('page-not-found');
})->where('any', '.*');
