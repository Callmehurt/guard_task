@extends('admin.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form action="{{ route('admin.update', $seller->id) }}" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">                <div class="form-group">
                    <label for="">Seller Name</label>
                    <input type="text" value="{{ $seller->name }}" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Seller Address</label>
                    <input type="text" value="{{ $seller->address }}" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Seller Email</label>
                    <input type="email" value="{{ $seller->email }}"  name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" @if ($seller->status == 'active')
                            selected
                        @endif>Active</option>
                        <option value="inactive" @if ($seller->status == 'inactive')
                            selected
                        @endif>In-Active</option>
                        <option value="terminated" @if ($seller->status == 'terminated')
                            selected
                        @endif>Terminated</option>
                        <option value="suspended" @if ($seller->status == 'suspended')
                            selected
                        @endif>Suspended</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
            </form>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
