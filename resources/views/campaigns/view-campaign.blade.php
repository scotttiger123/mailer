@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                    
                <div class="card-header">
                    <h3 class="card-title">View Campaigns</h3>
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
                    @if ($campaigns->isEmpty())
                        <div class="alert alert-info">
                            No Campaign available.
                        </div>
                    @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                
                                <th>Campaign Name</th>
                                <th>Group</th>
                                <th>Schedule Option</th>
                                <th>Start Date</th>
                                <th>Recurring Option</th>
                                <th>Template Option</th>
                                <th>Actions</th> <!-- Add a new column for actions -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $campaign)
                            <tr>
                                
                                <td>{{ $campaign->campaign_name }}</td>
                                <td>{{ optional($campaign->group)->group_name }}</td>

                                <td>{{ $campaign->schedule_option }}</td>
                                <td>{{ $campaign->start_date }}</td>
                                <td>{{ $campaign->recurring_option }}</td>
                                <td>{{ optional($campaign->template)->name }}</td>
                                
                                <td>
                                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(event)">
                                            <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                    <form action="{{ route('campaigns.resend', $campaign->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirmResend(event)">
                                            <i class="fas fa-redo"></i>
                                            Restart
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   function confirmDelete(event) {
    if (confirm("Are you sure you want to delete this campaign?")) {
        return true;
    } else {
        event.preventDefault(); // Prevent form submission
        return false;
    }
}
function confirmResend(event) {
        if (confirm("Are you sure you want to restart this campaign?")) {
            return true;
        } else {
            event.preventDefault(); // Prevent form submission
            return false;
        }
    }
</script>
@endsection
