@extends('layouts.master')

@section('content')
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h3>Add New Expense Entry:</h3>
                <form method="POST" action="{{ route('expenses.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="">Items : </label>
                        <input id="items" type="text" class="form-control @error('items') is-invalid @enderror" name="items" value="{{ old('items') }}" required autocomplete="items" placeholder="Enter an Item" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                    <label for="">Price :</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" placeholder="Enter Price" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Date: </label>
                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date" placeholder="Enter Date" autofocus>
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