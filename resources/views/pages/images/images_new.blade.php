@extends('layouts.app', ['activePage' => 'images', 'titlePage' => __("Avaiable Container")])

@push('js')
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Images Table</h4>
              <p class="card-category">Create New Container Image</p>
            </div>
            <div class="card-body">
              <div class="">
                  @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                  @endif
                  @if($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{$error}}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  {!! Form::open(['route' => 'images.store', 'method' => 'post']) !!}
                    @include('pages/images/images_form')
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
