@extends('layouts.master')

@section('content')

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h3>Edit Income:</h3>

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
                <form action="{{ route('income.update',$income->id) }}" method="POST">
                @csrf
                @method('PUT')

                
                <div class="form-group">
                    <label for="">Salary :</label>
                        <input id="price" type="number" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ $income->salary }}" required autocomplete="salary" placeholder="Enter Salary" autofocus>

                </div>
                <div class="form-group">
                    <label for="">Date: </label>
                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $income->date }}" required autocomplete="date" placeholder="Enter Date" autofocus>

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