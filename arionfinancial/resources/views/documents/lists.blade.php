@extends('layouts.Authorized')

@section('content')
@section('title', "Leasing")
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title" style="border-bottom: none;">
            <h2>Lists Contracts</h2>
        </div>
        <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(isset($data))
                   @foreach($data as $item)
                    <tr>
                        <td>{{$item->fname}}</td>
                        <td><a href="/documents?name={{$item->file_name}}">View</a></td>
                    </tr>
                    @endforeach
                @else
                    <h3>Data not found !</h3>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection