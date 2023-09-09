@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">View Templates</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success auto-hide">
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $template)
                                <tr>
                                    <td>{{ $template->name }}</td>
                                    <td>{{ $template->subject }}</td>
                                    <td>
                                        <button class="btn btn-info btn-sm view-template" data-template="{{ $template->id }}"><i class="fas fa-eye"></i> </button>
                                        <form action="{{ route('templates.destroy', $template->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">
                                             <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('templates.edit', $template->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="templateModal" tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- Add 'modal-md' class here -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="templateModalBody" style="max-height: 500px; overflow-y: auto;">
                <!-- Template details will be loaded here -->
            </div>
        </div>
    </div>
</div>
</style>
<script>
    function confirmDelete(event) {
        if (confirm("Are you sure you want to delete this template?")) {
            return true;
        } else {
            event.preventDefault(); // Prevent form submission
            return false;
        }
    }
</script>

@endsection
