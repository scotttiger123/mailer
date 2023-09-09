@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Campaign</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success auto-hide">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('campaigns.update', $campaign->id) }}" method="post">
                        @csrf
                        @method('PUT') <!-- Use the PUT method for updates -->
                        <div class="form-group">
                            <label for="campaign_name">Campaign Name</label>
                            <input type="text" class="form-control" id="campaign_name" name="campaign_name" value="{{ $campaign->campaign_name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="group_id">Select Group</label>
                            <select class="form-control" id="group_id" name="group_id" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" {{ $campaign->group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->group_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schedule_option">Schedule Option</label>
                            <select class="form-control" id="schedule_option" name="schedule_option" required>
                                <option value="instant" {{ $campaign->schedule_option == 'instant' ? 'selected' : '' }}>Send Instantly</option>
                                <option value="scheduled" {{ $campaign->schedule_option == 'scheduled' ? 'selected' : '' }}>Schedule with Start Date</option>
                            </select>
                        </div>
                        <div class="form-group" id="start_date_group" style="{{ $campaign->schedule_option == 'scheduled' ? 'display:block' : 'display:none' }}">
                            <label for="start_date">Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ $campaign->start_date }}">
                        </div>
                        <div class="form-group" id="recurring_option_group" style="{{ $campaign->schedule_option == 'scheduled' ? 'display:block' : 'display:none' }}">
                            <label for="recurring_option">Recurring Option</label>
                            <select class="form-control" id="recurring_option" name="recurring_option">
                                <option value="">Select Recurring Option</option>
                                <option value="daily" {{ $campaign->recurring_option == 'daily' ? 'selected' : '' }}>Every Day</option>
                                <option value="weekly" {{ $campaign->recurring_option == 'weekly' ? 'selected' : '' }}>Every Week</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="template_option">Select Template</label>
                            <select class="form-control" id="template_option" name="template_option" required>
                                <option value="">Select Template</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}" {{ $campaign->template_option == $template->id ? 'selected' : '' }}>
                                        {{ $template->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Campaign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    const scheduleOptionSelect = document.getElementById('schedule_option');
    const startDateGroup = document.getElementById('start_date_group');
    const recurringOptionGroup = document.getElementById('recurring_option_group');

    scheduleOptionSelect.addEventListener('change', () => {
        if (scheduleOptionSelect.value === 'scheduled') {
            startDateGroup.style.display = 'block';
            recurringOptionGroup.style.display = 'block';
        } else {
            startDateGroup.style.display = 'none';
            recurringOptionGroup.style.display = 'none';
        }
    });
</script>
@endsection
