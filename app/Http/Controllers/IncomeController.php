<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
            $year = $request->get('year');
            $month = $request->get('month');
    
            if($year && $month==null){
                $yearStart = $year . '-01-01';
                $yearEnd = $year . '-12-30';
                $query = Income::where('user_id',ucwords($user_id))
                            ->where('date','>=',$yearStart)
                            ->where('date','<=',$yearEnd)
                            ->get(); 
                $querySum = $query->sum('salary');
                return view('income.index',compact('query','querySum'));
                   
            }
            elseif($year && $month){
                $yearMonthStart = $year.'-'.$month.'-01';
                $yearMonthEnd = $year.'-'.$month.'-30';
                $query = Income::where('user_id',ucwords($user_id))
                            ->where('date','>=',$yearMonthStart)
                            ->where('date','<=',$yearMonthEnd)
                            ->get(); 
                $querySum = $query->sum('salary');
                return view('income.index',compact('query','querySum'));
            }
            elseif($year == null && $month == !null){
                return redirect()->route('income.index')
                ->with('error','Please Select Year for Month');
            }
            
     
            $query = Income::orderBy('date','desc')
                    ->where('user_id',ucwords($user_id))
                    ->paginate(5);
            $querySum = $query->sum('salary');
            return view('income.index',compact('query','querySum'));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('income.create');

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
            'salary' => 'required',
            'date' => 'required',
        ]);
        Income::create($request->all() + ['user_id' => $user_id]);
        return redirect()->route('income.index')
            ->with('success','Income Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
