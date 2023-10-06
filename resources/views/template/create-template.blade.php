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
                    <div class="mb-3">
                        <textarea class="textarea" placeholder="Place some text here" name = 'content' 
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        </textarea>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                </div>
                <!-- <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button> -->
              </div>
              <!-- /.card-footer -->
            </div>
            </form>
            <!-- /.card -->
          </div>
        
    </div>
    
</div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
      tabsize:2,
      height:300
    })
  });

</script>
@endsection

