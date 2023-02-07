@extends('layouts.master')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h4>Income List:</h4>
            <div>
                <a href="{{ route('income.create') }}" class="btn btn-primary">Add Expense</a></br></br>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Salary</th>
                    <th>Date</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($incomes as $income)
                <tr>
                    <td>{{ ++$i }}</td>  
                    <td>{{ $income->salary }}</td>
                    <td>{{ $income->date }}</td>
                    <td>
                        <form action="{{ route('income.destroy', $income->id)}}" method="POST">
                            <!-- <a class="btn btn-info" href="{{ route('income.show', $income->id) }}">Show</a> -->
                            <a class="fas fa-edit" href="{{ route('income.edit', $income->id) }}"></a>

                            @csrf
                            @method('DELETE')

                            <a type="submit" onclick="return confirm('Do you want to delete?');" class="fas fa-trash" style="color: red"></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $incomes->links() !!}

        </div>
        <!-- /.container-fluid -->
,
    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection