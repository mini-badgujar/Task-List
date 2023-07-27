<?php
use App\Models\Task;
use App\Http\Requests\TaskRequest;
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
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')->name('task.create');

Route::get('task/{task}/edit', function(Task $task){
    
    return view('edit',[
        'task'=> $task
    ]);
})->name('tasks.edit');

Route::get('task/{task}', function(Task $task){
    
    return view('show',[
        'task'=> $task
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully');

})->name('task.store');


Route::put('/tasks/{task}', function(Task $task ,TaskRequest $request){
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully');

})->name('task.update');

Route::delete('/task/{task}', function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted Successfully!');
})->name('task.destroy');

Route::put('/task/{task}/toggle-complete', function(Task $task){
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Task updated successfully');
})->name('task.toggle-complete');
