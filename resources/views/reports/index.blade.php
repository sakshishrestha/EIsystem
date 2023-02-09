@extends('layouts.master')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <!-- filter date here for reports lists  -->
            <form action="{{ route('reports') }}" method="POST">
                @csrf
                <h5>Search Expenses:</h5>
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <!-- <div class="col-sm-3" inline="true">
                                <label for="date">From Date:</label>
                                <input id="fromDate" type="date" class="form-control input-sm" name="fromDate" required autocomplete="date" placeholder="Enter Date" autofocus>

                            </div>
                            <div class="col-sm-3" inline="true">
                                <label for="date">To Date:</label>
                                <input id="toDate" type="date" class="form-control input-sm" name="toDate" required autocomplete="date" placeholder="Enter Date" autofocus>

                            </div> -->
                            <!-- <div class="col-sm-3" inline="true">
                                <label for="date">Pick Month and Year</label>
                                <input id="datepicker" type="month" class="form-control input-sm" name="monthyear" required autocomplete="date" placeholder="Enter Month" autofocus>

                            </div> -->
                            <div class="col-sm-6" inline="true">
                                <!-- <div class="form-group"> -->
                                    <div class='input-group' >                                                
                                        <select name="year" class="form-control input-sm">
                                        <option hidden disabled selected value>Select Year</option>
                                        @for ($year = date('Y'); $year > date('Y') - 100; $year--)
                                        <option value="{{$year}}">
                                                {{$year}}
                                        </option>
                                        @endfor
                                    </select>
                                    <select name="month" class="form-control input-lg">
                                        <option hidden disabled selected value>Select Month</option>
                                        @foreach(range(1,12) as $month)

                                                <option value="{{$month}}">
                                                        {{date("M", strtotime('2016-'.$month))}}
                                                </option>
                                        @endforeach
                                    </select>
                                    <select name="day" class="form-control input-sm">
                                        <option hidden disabled selected value>Select Day</option>
                                        @foreach(range(1,31) as $day)
                                                <option value="{{strlen($day)==1 ? '0'.$day : $day}}">
                                                        {{strlen($day)==1 ? '0'.$day : $day}}
                                                </option>
                                        @endforeach
                                    </select>
                                    </div>
                                <!-- </div> -->
                            </div> 
                            <div class="col-sm-3" inline="true">
                                <div class="input-group">
                                    <label for="search"></label></br>
                                    <button type="submit" name="search" class="btn btn-outline-secondary">Search <i class="fas fa-search"></i></button>
                                </div>
                                
                            </div>
                           

                        </div>
                    </div>
                    

                </div>
            </form>
            <table class="table table-bordered">
                <tr>
                    @php $i = 1; @endphp
                    <th>No</th>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Date</th>

                    <!-- <th width="280px">Action</th> -->
                </tr>
                @foreach ($query as $value)
                            
                <tr>
                    <td>{{ $i++ }}</td>  
                    <td>{{ $value->items }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->date }}</td>
                    
                </tr>
                @endforeach
            </table>
           
  
        <h5>Total Expenses = {{ $querySum }}</h5>

           
            
        </div>
  
       
        <!-- /.container-fluid -->
,
    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->



    

@endsection