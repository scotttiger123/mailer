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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Campaign Name</th>
                                <th>Group</th>
                                <th>Schedule Option</th>
                                <th>Start Date</th>
                                <th>Recurring Option</th>
                                <th>Template Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $campaign)
                            <tr>
                                <td>{{ $campaign->id }}</td>
                                <td>{{ $campaign->campaign_name }}</td>
                                <td>{{ $campaign->group_id }}</td>
                                <td>{{ $campaign->schedule_option }}</td>
                                <td>{{ $campaign->start_date }}</td>
                                <td>{{ $campaign->recurring_option }}</td>
                                <td>{{ $campaign->template_option }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
