<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\AvionController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\BateauController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\EstcController;
use App\Http\Controllers\MuseeLouvreController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Transport;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ReponseController; // Ajoutez cette ligne pour importer le modèle Transport
use App\Http\Controllers\WeLoveGreenController;
use App\Http\Controllers\YugaController;
use App\Models\MuseeLouvre;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\FedexController;



use App\Http\Controllers\PollutionController;
use App\Http\Controllers\SecuriteController;

// use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


// Route pour afficher le dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Assurez-vous que la vue dashboard existe
})->middleware('auth')->name('dashboard');

Route::resource('itineraires', ItineraireController::class);
Route::resource('transports', TransportController::class);
Route::get('/itinerairestem', [ItineraireController::class, 'itineraireStem'])->name('itinerairestem');
Route::get('/transportstem', [TransportController::class, 'transportStem'])->name('transportstem');
Route::get('/search-transport', [TransportController::class, 'search'])->name('transport.search');

Route::get('transports/{id}/download-pdf', [TransportController::class, 'downloadPDF'])->name('transports.download-pdf');




Route::resource('destinations', DestinationController::class);
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destination', [DestinationController::class, 'destination'])->name('destinations.destination');
Route::get('/destinations/{id}', [ActiviteController::class, 'show'])->name('destination');


Route::resource('events', EventController::class);
Route::get('/event', [EventController::class, 'event'])->name('events.event');
Route::resource('activites', ActiviteController::class);
Route::get('/activites/{id}', [ActiviteController::class, 'show'])->name('activite');
Route::resource('avis', AvisController::class);
Route::get('/activitestem', [ActiviteController::class, 'activiteStem'])->name('activitestem');
Route::get('/avisstem', [AvisController::class, 'avisStem'])->name('avisstem');
Route::post('/avis/{activite}', [AvisController::class, 'store'])->name('avis.store');


Route::post('activites/{id}/like', [ActiviteController::class, 'like'])->name('activites.like');
Route::post('activites/{id}/unlike', [ActiviteController::class, 'unlike'])->name('activites.unlike');

Route::delete('/avis/{avis}', [AvisController::class, 'destroy'])->name('avis.destroy');

Route::resource('certificats', CertificatController::class); // Added certificat routes
Route::resource('partenaires', PartenaireController::class);
Route::get('/certificatstem', [CertificatController::class, 'certificatStem'])->name('certificatstem'); // Added certificat stem route
Route::get('/partenaireStem', [PartenaireController::class, 'partenaireStem'])->name('partenaireStem'); // Added patenaire stem route
// Route to show audit logs for a specific partenaire
Route::get('partenaires/{id}/audits', [PartenaireController::class, 'showAuditLogs'])->name('partenaires.audits');

// Route to show all audit logs
Route::get('audits', [PartenaireController::class, 'auditLogs'])->name('audits.index');

Route::post('certificats/{id}/rate', [CertificatController::class, 'rate'])->name('certificats.rate');





Route::get('reclamations1', [ReclamationController::class, 'index1'])->name('reclamations.index1');
Route::resource('reclamations', ReclamationController::class);
Route::post('reclamations/{reclamation}/reponses', [ReponseController::class, 'store'])->name('reponses.store');
Route::delete('reclamations/{reclamation}/reponses/{reponse}', [ReponseController::class, 'destroy'])->name('reponses.destroy');
Route::post('reclamations/index2', [ReclamationController::class, 'index2'])->name('reclamations.index2');
Route::get('/reclamations/{id}/pdf', [ReclamationController::class, 'generatePDF'])->name('reclamation.pdf');
Route::get('reclamations/export-excel', [ReclamationController::class, 'exportExcel'])->name('reclamations.exportExcel');

// Route pour les statistiques des réclamations
Route::get('reclamations/stats', [ReclamationController::class, 'statistiques'])->name('reclamations.stats');

// Route pour exporter les statistiques en PDF
Route::get('reclamations/export-statistiques-pdf', [ReclamationController::class, 'exportStatistiquesPDF'])->name('reclamations.exportStatistiquesPDF');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/avion', [AvionController::class, 'store']);
Route::get('/avion/create', [AvionController::class, 'create']);
Route::get('/avions', [AvionController::class, 'index'])->name('avions.index');
Route::post('/bus', [BusController::class, 'store']);
Route::get('/bus/create', [BusController::class, 'create']);
Route::get('/bus', [BusController::class, 'index'])->name('bus.index');
Route::post('/bateau', [BateauController::class, 'store']);
Route::get('/bateau/create', [BateauController::class, 'create']);
Route::get('/bateau', [BateauController::class, 'index'])->name('bateau.index');

Route::post('/yuga', [YugaController::class, 'store']);
Route::get('/yuga/create', [YugaController::class, 'create']);
Route::get('/yuga', [YugaController::class, 'index'])->name('yuga.index');

Route::post('/museelouvre', [MuseeLouvreController::class, 'store']);
Route::get('/museelouvre/create', [MuseeLouvreController::class, 'create']);
Route::get('/museelouvre', [MuseeLouvreController::class, 'index'])->name('museelouvre.index');

Route::post('/welovegreen', [WeLoveGreenController::class, 'store']);
Route::get('/welovegreen/create', [WeLoveGreenController::class, 'create']);
Route::get('/welovegreen', [WeLoveGreenController::class, 'index'])->name('welovegreen.index');

Route::post('/estc', [EstcController::class, 'store']);
Route::get('/estc/create', [EstcController::class, 'create']);
Route::get('/estc', [EstcController::class, 'index'])->name('estc.index');
//delete
Route::delete('/avion/{id}', [AvionController::class, 'destroy'])->name('avions.destroy');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);});



Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::post('/bookings', [BookingController::class, 'store']);
Route::delete('/bookings/{id}', [BookingController::class, 'destroy']);

Route::post('/bookings/add', [BookingController::class, 'addBooking'])->name('booking.addBooking');



Route::get('/fedex', [FedexController::class, 'index'])->name('fedex.index');
Route::post('/addFedex', [FedexController::class, 'addFedex'])->name('fedex.addFedex');



// Sécurité Routes
Route::get('/securite', [SecuriteController::class, 'index'])->name('securite.index');
Route::get('/securite/create', [SecuriteController::class, 'create'])->name('securite.create');
Route::post('/securite', [SecuriteController::class, 'store'])->name('securite.store');
Route::get('/securite/{id}/edit', [SecuriteController::class, 'edit'])->name('securite.edit');
Route::put('/securite/{id}', [SecuriteController::class, 'update'])->name('securite.update');
Route::delete('/securite/{id}', [SecuriteController::class, 'destroy'])->name('securite.destroy');

// Pollution Routes
Route::get('/pollution', [PollutionController::class, 'index'])->name('pollution.index');
Route::get('/pollution/create', [PollutionController::class, 'create'])->name('pollution.create');
Route::post('/pollution', [PollutionController::class, 'store'])->name('pollution.store');


