@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div id="printable" class="card-body mt-4 text-center">
                    <img style="width:250px" src="{{ asset($employee->image) }}" alt="{{ $employee->name }}">
                    <h1 class="mt-1">
                        {{ $employee->name }}
                    </h1>
                    <p>
                        <b>E-mail: </b> {{ $employee->email }}
                    </p>
                    <p>
                        <b>Phone Number: </b> {{ $employee->phone_no }}
                    </p>
                    <p>
                        <b>Salary: </b> {{ $employee->salary->salary }}
                    </p>
                    <p>
                        <b>Address: </b> {{ $employee->address }}
                    </p>
                    <div class="avoid-this">
                        @if(Auth::user())
                        <a href="#" class="btn btn-success print">Print PDF</a>
                        @endif
                        <a href="{{ route('home') }}" class="btn btn-info">Back To Home</a>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('.print').on('click', function(e) {
                e.preventDefault();
                $("#printable").print({

                    // Use Global styles
                    globalStyles : true,

                    // Add link with attrbute media=print
                    mediaPrint : false,

                    //Custom stylesheet
                    stylesheet : "",

                    //Print in a hidden iframe
                    iframe : false,

                    // Don't print this
                    noPrintSelector : ".avoid-this",

                    // Add this on top
                    append : "",

                    // Add this at bottom
                    prepend : "",

                    // Manually add form values
                    manuallyCopyFormValues: true,

                    // resolves after print and restructure the code for better maintainability
                    deferred: $.Deferred(),

                    // timeout
                    timeout: 250,

                    // Custom title
                    title: '{{ $employee->name }}',

                    // Custom document type
                    doctype: '<!doctype html>'

                });
            });
        });
    </script>
@endsection