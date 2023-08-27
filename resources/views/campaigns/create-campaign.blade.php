@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Campaign Scheduler </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('campaign') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="campaign_name">Campaign Name</label>
                            <input type="text" class="form-control" id="campaign_name" name="campaign_name" required>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success auto-hide" >
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="group_id">Select Group</label>
                            <select class="form-control" id="group_id" name="group_id" required>
                                <option value="">Select Group</option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="schedule_option">Schedule Option</label>
                            <select class="form-control" id="schedule_option" name="schedule_option" required>
                                <option value="instant">Send Instantly</option>
                                <option value="scheduled">Schedule with Start Date</option>
                            </select>
                        </div>
                        <div class="form-group" id="start_date_group" style="display: none;">
                            <label for="start_date">Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_date" name="start_date">
                        </div>
                        <div class="form-group" id="recurring_option_group" style="display: none;">
                            <label for="recurring_option">Recurring Option</label>
                            <select class="form-control" id="recurring_option" name="recurring_option">
                                <option value="">Select Recurring Option</option>
                                <option value="daily">Every Day</option>
                                <option value="weekly">Every Week</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="template_option">Select Template</label>
                            <select class="form-control" id="template_option" name="template_option" required>
                                <option value="">Select Template</option>
                                <option value="template1">Template 1</option>
                                <option value="template2">Template 2</option>
                                <option value="template3">Template 3</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Schedule Mail</button>
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
