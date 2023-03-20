<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Models\Expense;
use Illuminate\Http\Request;
use Auth;
use App\Imports\ImportExpense;
use App\Exports\ExportExpense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    
    public function index()
    {
        $user_id = Auth::user()->id;
        $expenses = Expense::orderBy('date','desc')->where('user_id',ucwords($user_id))->paginate(5);
        return view('expenses.index',compact('expenses'))
            ->with('i',(request()->input('page',1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $request->validate([
            'items' => 'required',
            'price' => 'required',
            'date' => 'required',
        ]);

        Expense::create($request->all() + ['user_id' => $user_id]);

        return redirect()->route('expenses.index')
            ->with('success','Expense Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('expenses.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        return view('expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'items' => 'required',
            'price' => 'required',
            'date' => 'required',
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index')
            ->with('success','Expenses updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')
            ->with('success','Expense deleted successfully');
    }

    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportExpense, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportExpenses(Request $request){
        // return $request;
        return Excel::download(new ExportExpense, 'expenses.xlsx');
    }

}
