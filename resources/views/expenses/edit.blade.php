@extends('layouts.master')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h3>Edit Expense:</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>There were some problem with your input.</br></br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form action="{{ route('expenses.update',$expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Items : </label>
                        <input id="items" type="text" class="form-control @error('items') is-invalid @enderror" name="items" value="{{ $expense->items }}" required autocomplete="items" placeholder="Enter an Item" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Price :</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $expense->price }}" required autocomplete="price" placeholder="Enter Price" autofocus>

                </div>
                <div class="form-group">
                    <label for="">Date: </label>
                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $expense->date }}" required autocomplete="date" placeholder="Enter Date" autofocus>

                </div>
                
                
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <button type="cancel" class="btn btn-danger">
                    Cancel
                </button>
            </form>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->


@endsection