@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    Employee Details

                    @if(Auth::user()) 
                        {{--  If User Logged in then route to create employee view  --}}
                        <a href="#" class="btn btn-warning print float-right">Print PDF</a>
                        <a href="{{ route('empoloyee.create') }}" class="btn btn-primary float-right mr-3">Add New Employee</a>
                    @endif
                </div>

                <div class="card-body">
                    {{--  table for employees  --}}
                    @if(isset($employees) && $employees->count() > 0)
                    <table id="datatable" class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>E-mail</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th class="avoid-this">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>
                                    <a href="{{ route('empoloyee.show', $employee->id) }}">
                                        <img style="widht:100px; height:100px" src="{{ asset($employee->image) }}" alt="{{ $employee->name }}">
                                    </a>
                                </td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone_no }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->salary->salary }} BDT</td>
                                <td class="avoid-this">
                                    <a href="{{ route('empoloyee.show', $employee->id) }}" class="btn btn-sm btn-success">Show</a>
                                    <br>
                                    @if(Auth::user())
                                    <a href="{{ route('empoloyee.edit', $employee->id) }}" class="btn btn-sm btn-primary mt-2">Edit</a>
                                    <form action="{{ route('empoloyee.destroy', $employee->id) }}" method="Post" >
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-sm btn-danger mt-2" value="Delete">
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{--  end table  --}}

                    @else   
                        <div class="alert alert-danger">No Employees Added Yet!</div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "order": [[ 0, "desc" ]]
            });
        });


        $(function() {
            $('.print').on('click', function(e) {
                e.preventDefault();
                $("#datatable").print({

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
                    title: 'Employee Details',

                    // Custom document type
                    doctype: '<!doctype html>'

                });
            });
        });
    </script>
@endsection