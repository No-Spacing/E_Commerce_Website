@extends('layouts.admin.admin')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/admin/adminAdBanner.css') }}" />

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="card mb-4 mb-xl-0">
    <div class="card-header"><h4>Banners</h4></div>
        <div class="card-body">  
            <div class="pt-3">
                <form action="{{ route('upload.banner') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="pb-5">
                        <label for="image" class="form-label">Upload Image Banner</label>
                        <span class="text-danger">@error('image'){{ $message }} @enderror</span>
                        <input class="form-control form-control-md w-25" id="image" name="image" type="file">
                        <div class="form-text">Note: Upload only 1920 x 1080 image resolution.</div>
                        <button type="submit" class="btn btn-primary mt-3" type="button">Upload</button>
                    </div>
                </form>
                <form id="setBanner" action="{{ route('set.banner') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(Session::get('success'))
                        <div class="alert alert-success d-flex justify-content-center">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach($banners as $key=>$banner)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td><img style="width: 250px; height: 150px;" src="{{ asset($banner->image) }}"></td>
                                    <td>{{ $banner->name }}</td>
                                    <td>
                                        @if($banner->setValue == 1)
                                            <input type="hidden" value="0" name="checked[{{ $banner->id }}]">
                                            <input type="checkbox" id="{{ $banner->name }}" name="checked[{{ $banner->id }}]" class="btn-check" value="1" checked>
                                            <label class="btn btn-outline-primary" for="{{ $banner->name }}">Set as banner</label>
                                            <a href="{{ route('delete.banner', ['id' => $banner->id ]) }}" class="btn btn-danger btn-md">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        @else
                                            <input type="hidden" value="0" name="checked[{{ $banner->id }}]">
                                            <input type="checkbox" id="{{ $banner->name }}" name="checked[{{ $banner->id }}]" class="btn-check" value="1">
                                            <label class="btn btn-outline-primary" for="{{ $banner->name }}">Set as banner</label>
                                            <a href="{{ route('delete.banner', ['id' => $banner->id ]) }}" class="btn btn-danger btn-md">
                                                <i class="fa fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    
                </table>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mt-3 btn-lg" type="button">Apply Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    new DataTable('#table');
</script>
@stop
