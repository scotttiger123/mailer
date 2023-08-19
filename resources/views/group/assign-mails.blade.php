@extends('layouts.app')
    @section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content" style =  "padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Assign E-mails</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success auto-hide" >
                            {{ session('success') }}
                        </div>
                    @endif
                    @error('file')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="group_name">Group Name</label>
                            <select class="form-control" id="group_name" name="group_id" required>
                                <option value="">Select Group Name</option>
                                @foreach ($groupNames as $id => $groupName)
                                    <option value="{{ $id }}">{{ $groupName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="assign_email">E-mails</label> (can paste bulk mail address)
                            <textarea class="form-control" id="assign_email" name="assign_emails_json" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email_list">Upload Email List</label> (excel formate)
                            <input type="file" class="form-control" id="email_list" name="email_list" accept=".csv,.xlsx">
                        </div>
                        <label for="csv_file">Upload CSV File:</label>
                        1<input type="file" name="file" accept=".csv">
                        <button type="submit" class="btn btn-primary">Create Group</button>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

    @endsection

    