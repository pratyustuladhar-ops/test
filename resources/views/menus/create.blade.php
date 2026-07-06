@extends('layout.app')

@section('title', 'Add Module')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow border-0">

                <div class="card-header bg-success text-white">

                    <h3 class="mb-0">➕ Add Module</h3>
                    <small>Create a new system module</small>

                </div>

                <div class="card-body">

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form action="{{ route('menus.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">Module Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter Module Name"
                                   value="{{ old('name') }}"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">Slug</label>

                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   placeholder="Example: products"
                                   value="{{ old('slug') }}"
                                   required>

                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="{{ route('menus.index') }}"
                               class="btn btn-secondary">

                                ← Back

                            </a>

                            <button class="btn btn-success">

                                Save Module

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection