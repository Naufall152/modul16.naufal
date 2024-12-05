<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */


    public function index()
    {
        $pageTitle = 'Employee List';

        // RAW SQL QUERY
        $employees = DB::select('
            select *, employees.id as employee_id, positions.name as
            position_name
            from employees
            left join positions on employees.position_id = positions.id
            ');
        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Employee';
        // RAW SQL Query
        $positions = DB::select('select * from positions');
        return view('employee.create', compact('pageTitle', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            'position' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // INSERT QUERY
        DB::table('employees')->insert([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'age' => $request->age,
            'position_id' => $request->position,
        ]);
        return redirect()->route('employees.index')->with('success', 'Data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';
        // RAW SQL QUERY
        $employee = collect(DB::select('select *, employees.id as employee_id, positions.name as
        position_name
        from employees
        left join positions on employees.position_id = positions.id
        where employees.id = ?
        ', [$id]))->first();
        return view('employee.show', compact('pageTitle', 'employee'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $positions = DB::select('select * from positions');
        $employee = Employee::findOrFail($id); // Ambil data employee berdasarkan ID
        return view('employee.edit', compact('employee', 'positions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:18',
            'position' => 'required|string|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'age' => $request->age,
            'position_id' => $request->position,
        ]);

        return redirect()->route('employees.index')->with('success', 'Data updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('employees')->where('id', $id)->delete();
        return redirect()->route('employees.index')->with('success', 'Data deleted successfully');
    }
}

