<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $fromDate = $request->get('fromDate');
        $toDate = $request->get('toDate');

        $year = $request->get('year');
        $month = $request->get('month');
        $day = $request->get('day');

        if($year && $month==null && $day==null){
            $yearStart = $year . '-01-01';
            $yearEnd = $year . '-12-30';
            $query = Expense::where('user_id',ucwords($user_id))
                        ->where('date','>=',$yearStart)
                        ->where('date','<=',$yearEnd)
                        ->get(); 
            $queryIncome = Income::where('user_id',ucwords($user_id))
            ->where('date','>=',$yearStart)
            ->where('date','<=',$yearEnd)
            ->get(); 
            $querySum = $query->sum('price');
            $queryIncomeSum = $queryIncome->sum('salary');
            $saving = $queryIncomeSum - $querySum;
            return view('reports.index',compact('query','querySum','queryIncomeSum','saving'))
            ->with('i', (request()->input('page', 1) * 10));
               
        }
        elseif($year == !null && $month && $day==null){
            $monthStart = $year.'-'.$month.'-01';
            $monthEnd = $year.'-'.$month.'-30';
            $query = Expense::where('user_id',ucwords($user_id))
                        ->where('date','>=',$monthStart)
                        ->where('date','<=',$monthEnd)
                        ->get(); 
            $queryIncome = Income::where('user_id',ucwords($user_id))
                        ->where('date','>=',$monthStart)
                        ->where('date','<=',$monthEnd)
                        ->get();
            $querySum = $query->sum('price');
            $queryIncomeSum = $queryIncome->sum('salary');
            $saving = $queryIncomeSum - $querySum;
            return view('reports.index',compact('query','querySum','queryIncomeSum','saving'))
            ->with('i', (request()->input('page', 1) * 10));
        }
        elseif($year ==!null && $month == !null && $day ){
            $dayStart = $year.'-'.$month.'-'.$day;
            $dayEnd = $year.'-'.$month.'-'.$day;
            $query = Expense::where('user_id',ucwords($user_id))
                        ->where('date','>=',$dayStart)
                        ->where('date','<=',$dayEnd)
                        ->get(); 
            $queryIncome = Income::where('user_id',ucwords($user_id))
                        ->where('date','>=',$year.'-'.$month.'-01')
                        ->where('date','<=',$year.'-'.$month.'-30')
                        ->get();
            $querySum = $query->sum('price');
            $queryIncomeSum = $queryIncome->sum('salary');
            $saving = $queryIncomeSum - $querySum;
            return view('reports.index',compact('query','querySum','queryIncomeSum','saving'))
            ->with('i', (request()->input('page', 1) * 10));
        }
        elseif($year == null && $month == !null){
            return redirect()->route('reports')
            ->with('error','Please Select Year for Month');
        }
        elseif($month == null && $day == !null){
            return redirect()->route('reports')
            ->with('error','Please Select Month for Day');
        }
        elseif($fromDate && $toDate){
            $query = Expense::where('user_id',ucwords($user_id))
                    ->where('date', '>=', $fromDate)
                    ->where('date', '<=', $toDate) 
                    ->paginate(10);
            $queryIncome = Income::where('user_id',ucwords($user_id))
                    ->where('date','>=',$fromDate)
                    ->where('date','<=',$toDate)
                    ->get();
            $querySum = $query->sum('price');
            $queryIncomeSum = $queryIncome->sum('salary');
            $saving = $queryIncomeSum - $querySum;
            return view('reports.index',compact('query','querySum','queryIncomeSum','saving'))
            ->with('i', (request()->input('page', 1) * 10));

        } 
        $query = Expense::orderBy('date','desc')
                ->where('user_id',ucwords($user_id))
                ->paginate(5);
        $queryIncome = Income::orderBy('date','desc')
                ->where('user_id',ucwords($user_id))
                ->paginate(5);
        $querySum = $query->sum('price');
        $queryIncomeSum = $queryIncome->sum('salary');
        $saving = $queryIncomeSum - $querySum;

        return view('reports.index',compact('query','querySum','queryIncomeSum','saving'))
        ->with('i', (request()->input('page', 1) * 10));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
