@extends('layouts.master')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h4>Expenses List:</h4>
            <div>
                <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a></br></br>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Items</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($expenses as $expense)
                <tr>
                    <td>{{ ++$i }}</td>  
                    <td>{{ $expense->items }}</td>
                    <td>{{ $expense->price }}</td>
                    <td>{{ $expense->date }}</td>
                    <td>
                        <form action="{{ route('expenses.destroy', $expense->id)}}" method="POST">
                            <!-- <a class="btn btn-info" href="{{ route('expenses.show', $expense->id) }}">Show</a> -->
                            <a class="fas fa-edit" href="{{ route('expenses.edit', $expense->id) }}"></a>

                            @csrf
                            @method('DELETE')

                            <a type="submit" onclick="return confirm('Do you want to delete?');" class="fas fa-trash" style="color: red"></a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            {!! $expenses->links() !!}

        </div>
        <!-- /.container-fluid -->
,
    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

@endsection