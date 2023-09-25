<?php

use App\Http\Controllers\Api\EmpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('emps', function(){
return 'This is API';
});
Route::get('employees',[EmpController::class,'getAllEmp']);
Route::post('employees',[EmpController::class,'createEmp']);
Route::get('employees/{emp_id}',[EmpController::class,'getOneEmp']);
Route::put('employees/{emp_id}',[EmpController::class,'updateEmp']);
Route::delete('employees/{emp_id}',[EmpController::class,'deleteEmp']);