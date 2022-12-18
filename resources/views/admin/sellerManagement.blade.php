@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <form action="{{ route('admin.createSeller') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">Seller Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Seller Address</label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Seller Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $pep)
                    <tr>
                        <td>{{ $pep->name }}</td>
                        <td>{{ $pep->email }}</td>
                        <td>{{ $pep->address }}</td>
                        <td>
                            @if ($pep->document != '' || $pep->document != null)
                            <a href="{{ route('admin.downloadDoc', $pep->id) }}" target="_blank"><button class="btn btn-sm btn-primary">Download</button></a>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" style="color: white;text-transform: Capitalize">{{ $pep->status }}</button>
                        </td>
                        <td>
                            <a href="{{ route('admin.edit', $pep->id) }}"><button class="btn btn-sm btn-primary">Edit</button></a>
                            <a href="{{ route('admin.delete', $pep->id) }}"><button class="btn btn-sm btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
