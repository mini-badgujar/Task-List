  <?php

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


//creating route and naming it we can check that using php artisan route:list cammand in terminal
//added bable template index.bable.php and using it for another data.
Route::get('/', function () {
    return view('index', [
        'name' => 'damini'
    ]);
})->name('Main page');

//another route
Route::get('/hello', function(){
    return "Hello this is another page route";
})->name('hellp');

// dynamic route
Route::get('/greet/{name}',function($name){
    return "Hello ".$name ." !";
});
// redirecting route
Route::get('/anything', function(){
    return redirect('/hello');
});

//fallback route which will work if none route works
Route::fallback(function(){
    return "still got somewhere";
});