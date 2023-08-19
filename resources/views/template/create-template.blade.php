@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
        <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"> Template</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="{{ route('template.create') }}" method="post">
                        @csrf
                        @if (session('success'))
                        <div class="alert alert-success auto-hide" >
                            {{ session('success') }}
                        </div>
                        @endif
                <div class="form-group">
                    <label for="group_name">Template Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="group_name">Mail Subject </label>
                    <input type="text" class="form-control" id="name" name="subject" required>
                </div>
                <div class="form-group">
                <label for="group_name">Mail Body </label>
                    <textarea id="compose-textarea" class="form-control" style="height: 300px" name = 'content' ><br>
                    <br>
                     <br><br><br><br><br><br><br><br>
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
              </div>
              <!-- /.card-footer -->
            </div>
            </form>
            <!-- /.card -->
          </div>
        
    </div>
    
</div>

@endsection

