@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Template</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('templates.update', $template->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        @if (session('success'))
                            <div class="alert alert-success auto-hide">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger auto-hide">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Template Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $template->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Mail Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ $template->subject }}" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Mail Body</label>
                            <textarea id="compose-textarea" class="form-control" style="height: 300px" name="content" required>{{ $template->content }}</textarea>
                        </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                    </div>
                </div>
                <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@endsection
