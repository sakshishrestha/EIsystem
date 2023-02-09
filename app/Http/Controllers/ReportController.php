<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        // $fromDate = $request->get('fromDate');
        // $toDate = $request->get('toDate');
        
        // if(request()->get('fromDate') && request()->get('toDate')){
        //     $expenses = DB::table('expenses')->select()
        //     ->where('date', '>=', $fromDate)
        //     ->where('date', '<=', $toDate) 
        //     ->paginate(10);
        //     $total = $expenses->sum('price');
            
        //     return view ('reports.index',compact('expenses','total'))
        //     ->with('i', (request()->input('page', 1) * 10));
        // }
        // $monthyear = $request->get('monthyear');
        // $monthexpense = Expense::whereMonth("created_at",">=", Carbon::now()->month)->get();

        // dd($monthexpense);
        // $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        // $dateE = Carbon::now()->startOfMonth();
        // $totalSpent = Expense::select('items','price','date')
        //                 ->whereBetween('date',[$dateS,$dateE])
        //                 ->get();
        
        

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
            $querySum = $query->sum('price');
            return view('reports.index',compact('query','querySum'));
               
        }
        elseif($year == !null && $month && $day==null){
            $monthStart = $year.'-'.$month.'-01';
            $monthEnd = $year.'-'.$month.'-30';
            $query = Expense::where('user_id',ucwords($user_id))
                        ->where('date','>=',$monthStart)
                        ->where('date','<=',$monthEnd)
                        ->get(); 
            $querySum = $query->sum('price');
            return view('reports.index',compact('query','querySum'));
        }
        elseif($year ==!null && $month == !null && $day ){
            $dayStart = $year.'-'.$month.'-'.$day;
            $dayEnd = $year.'-'.$month.'-'.$day;
            $query = Expense::where('user_id',ucwords($user_id))
                        ->where('date','>=',$dayStart)
                        ->where('date','<=',$dayEnd)
                        ->get(); 
            $querySum = $query->sum('price');
            return view('reports.index',compact('query','querySum'));
        }
        elseif($year == null && $month == !null){
            echo "Please Select Year for Month";
        }
        elseif($month == null && $day == !null){
            echo "Please Select Month for Day";
        }
 
        $query = Expense::orderBy('date','desc')
                ->where('user_id',ucwords($user_id))
                ->paginate(5);
        $querySum = $query->sum('price');
        return view('reports.index',compact('query','querySum'));
        
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
