@extends('layouts.master')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- <h4>Income List:</h4>
            <div>
                <a href="{{ route('income.create') }}" class="btn btn-primary">Add Expense</a></br></br>
            </div> -->

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ route('income.index') }}" method="POST">
                @csrf {{ method_field('GET') }}
                <h5>Search Income:</h5>
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row">
                            <div class="col-sm-6" inline="true">
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
                                </div>
                            </div> 
                            <div class="col-sm-2" inline="true">
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
                    @php $i=1; @endphp
                    <th>No</th>
                    <th>Salary</th>
                    <th>Date</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($query as $income)
                <tr>
                    <td>{{ $i++ }}</td>  
                    <td>{{ $income->salary }}</td>
                    <td>{{ $income->date }}</td>
                    <td>
                        <form action="{{ route('income.destroy', $income->id)}}" method="POST">
                            <a class="fas fa-edit" href="{{ route('income.edit', $income->id) }}"></a>

                            @csrf
                            @method('DELETE')

                            <a type="submit" onclick="return confirm('Do you want to delete?');" class="fas fa-trash" style="color: red"></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <h5>Total Income = {{ $querySum }}</h5>
           

        </div>
        <!-- /.container-fluid -->
,
    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection