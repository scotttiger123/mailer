@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Group Name</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success auto-hide">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger auto-hide">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{ route('group') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="group_name">Group Name</label>
                            <input type="text" class="form-control" id="group_name" name="group_name" required>
                        </div>
                        <div class="form-group">
                            <label for="group_description">Group Description</label>
                            <textarea class="form-control" id="group_description" name="group_description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="group_type">Group Type</label>
                            <select class="form-control" id="group_type" name="group_type">
                                <option value="work">Work</option>
                                <option value="social">Social</option>
                                <option value="hobby">Hobby</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="group_category">Group Category</label>
                            <select class="form-control" id="group_category" name="group_category">
                                <option value="sports">Sports</option>
                                <option value="business">Business</option>
                                <option value="technology">Technology</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="privacy_settings">Privacy Settings</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy_settings" id="public" value="public" checked>
                                <label class="form-check-label" for="public">Public</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy_settings" id="private" value="private">
                                <label class="form-check-label" for="private">Private</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="privacy_settings" id="invite_only" value="invite_only">
                                <label class="form-check-label" for="invite_only">Invite Only</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Group</button>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection
