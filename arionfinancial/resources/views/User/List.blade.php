@extends('layouts.Authorized')

@section('content')
@section('title', 'Details')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
          <h2><?php 
          if($RoleID == 1)
          { 
            echo 'My Dealers'; 
          }
          elseif($RoleID  == 2)
          { 
            echo 'My Customer'; 
          } 
          ?>
                    
                </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          
          <table id="datatable" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>UserName</th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Is Active</th>
                @if($RoleID == '2')
                <th>Contracts</th>
                @endif
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
                @foreach($Users as $User)

                    <tr>
                        @if($RoleID == 2)
                            <td><a href="{!! route('Contracts', ['CustomerID' => $User->UserID ]) !!}">{!! $User->UserName !!}</a></td>
                        @else
                            <td>{!! $User->UserName !!}</td>
                        @endif
                        <td>{!! $User->EmailAddress !!}</td>
                        <td>{!! $User->FirstName !!}</td>
                        <td>{!! $User->LastName !!}</td>
                        <td>{!! $User->IsActive ? "Yes" : "No" !!}</td>
                        @if($RoleID == '2')
                        <td><a href="{!! URL('Contracts', ['ID' => $User->UserID]) !!}">View Contracts</a></td>
                        @endif
                        <td><a href="{!! URL('User', ['ID' => $User->UserID]) !!}">Edit</a></td>
                        <td><a href="{!! URL('DeleteUser', ['ID' => $User->UserID]) !!}">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
@endsection