<?php
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
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
// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {
//     }
// }

// $tasks = [
//     new Task(
//         1,
//         'Buy groceries',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Sell old stuff',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Learn programming',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Take dogs for a walk',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

//creating route and naming it we can check that using php artisan route:list cammand in terminal
// Route::get('/', function(){
//     return redirect()->route('tasks.index');
// });

// Route::get('/tasks', function() use($tasks) {
//     return view('index', ['tasks' => $tasks]);
// })->name('tasks.index');


// Route::get('/tasks/{id}', function($id){
//     return "single task";
// })->name('tasks.show');

//Layouts Using Template Inheritence
// Route::get('/tasks/{id}', function($id) use ($tasks){
//     $task = collect($tasks)->firstWhere('id',$id);
    
//     if(!$task){
//         abort(Response::HTTP_NOT_FOUND);
//     }
//     return view('show',['task'=>$task]);
// })->name('tasks.show');


// //another route
// Route::get('/hello', function(){
//     return "Hello this is another page route";
// })->name('hellp');

// // dynamic route
// Route::get('/greet/{name}',function($name){
//     return "Hello ".$name ." !";
// });
// // redirecting route
// Route::get('/anything', function(){
//     return redirect('/hello');
// });

// //fallback route which will work if none route works
// Route::fallback(function(){
//     return "still got somewhere";
// });
//
//_____________Importing data using models and migration______________________________________________________________________________________________________

Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function(){
    return view('index', [
        'tasks' =>  \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('task.create');

Route::get('task/{id}/edit', function($id){
    
    return view('edit',[
        'task'=> \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.edit');

Route::get('task/{id}', function($id){
    
    return view('show',[
        'task'=> \App\Models\Task::findOrFail($id)
    ]);
})->name('tasks.show');

Route::post('/tasks', function(Request $request){
    $data = $request -> validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',

    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully');

})->name('task.store');


Route::put('/tasks/{id}', function($id,Request $request){
    $data = $request -> validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',

    ]);

    $task = Task::findOrFail($id);
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();
    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task updated successfully');

})->name('task.update');