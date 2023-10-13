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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                            <label for="assign_email">E-mails</label> (can paste bulk mail address formate :abc@gmail.com xyx@yahoo.com yyx@gmail.com))
                            <textarea class="form-control" id="assign_email" placeholder = "xyx@gmail.com abc@gmail.com yyx@gmail.com"name="assign_emails_json" rows="3" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email_list">Upload Email List</label> (excel formate)
                            <input type="file" class="form-control" id="email_list" name="email_list" accept=".xlsx">
                        </div>
                        <button type="submit" class="btn     btn-primary">Save </button>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

    @endsection

    