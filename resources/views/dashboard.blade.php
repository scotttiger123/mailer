@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
        <div class="row">
                <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="plan-details">
                                @if ($package)
                                    <p><strong>Plan:</strong> {{ $package->name }}</p>
                                @else
                                    <p>You are not subscribed to any plan.</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('pricing') }}" class="btn btn-primary btn-upgrade">Upgrade Plan</a>
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </div>    
        <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Emails </span>
                            <span class="info-box-number">{{ $TotalEmailLog }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-file-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Templates</span>
                            <span class="info-box-number">{{ $totalTemplates }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Groups</span>
                            <span class="info-box-number">{{ $totalGroups }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-paper-plane"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Campaigns</span>
                            <span class="info-box-number">{{ $totalCampaigns }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Email Analytics Chart -->
            <div class="row" hidden>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Email Analytics</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="emailChart" style="height: 250px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
             <!-- Campaign Selection Dropdown -->
             <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Campaign Analytics</h3>
                        </div>
                        <div class="card-body">
                                <div class="row mb-6">
                                    <div class="col-md-3">
                                        <form id="campaignSelectForm" action="" method="GET">
                                            <label for="exampleSelectBorder">Select a Campaign </label>
                                            <select class="custom-select form-control-border" id="campaignSelect">   
                                                <option value="">Select a campaign</option>
                                                @foreach($campaigns as $campaignId => $campaignName)
                                                    <option value="{{ $campaignId }}">{{ $campaignName }}</option>
                                                @endforeach
                                            </select>
                                            
                                        </form>
                                    </div>
                                    <div class="col-md-3">
                                            <button id="getDataButton" class="btn btn-success" style="margin-top:31px">Submit</button>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                    <div  class="overlay d-flex justify-content-center align-items-center" >
                                        <i id = loader class="fas fa-2x fa-sync fa-spin" style = "display:none"></i>
                                    </div>
                                        <div class="col-md-12">
                                        <div class="box-body">
                                            <div id="dataDisplay">
                                                <!-- Data will be displayed here inside the box -->
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card" style = "width : 100%; display:none;" id = 'gridCard' >
                                        <div class="card-header border-0" style = "background-color:white">
                                            <h3 class="card-title" style = "color:black">Data Grid</h3>
                                          </div>
                                    <div class="table-container" style = "width : 100%">
                                    <table class="table table-bordered" >
                                            <table class="table table-striped table-valign-middle" id="emailLogTable">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Recipient Email</th>
                                                    <th>Sent at </th>
                                                    <th>Opened</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data will be populated here using JavaScript -->
                                            </tbody>
                                        </table>
                                    </div> 
</div>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>           
                       
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<style>
    /* Add this CSS to your stylesheet */
.table-container {
    max-height: 400px; /* Set the maximum height of the table container */
    overflow-y: auto; /* Add a vertical scrollbar if content overflows */
}

/* Make the header sticky */
#emailLogTable thead {
    position: sticky;
    top: 0;
    background-color: white; /* Adjust background color as needed */
}

    </style>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example data for the email analytics chart
    var emailData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Sent Emails',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            data: [500, 800, 1000, 700, 900, 1200, 1500]
        }]
    };

    // Get the canvas element and initialize the chart
    var emailChart = document.getElementById('emailChart').getContext('2d');
    new Chart(emailChart, {
        type: 'bar',
        data: emailData,
        options: {
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var loader = $('#loader');
        var dataDisplay = $('#dataDisplay');
        var emailLogTable = $('#emailLogTable');
        var gridCard = $('#gridCard');

        $('#getDataButton').click(function () {
            function formatDate(date) {
        var options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        return date.toLocaleDateString(undefined, options);
    }
            // Get the selected campaign ID from the dropdown
            var selectedCampaignId = $('#campaignSelect').val();
            
            
            loader.show();
            dataDisplay.hide();
            emailLogTable.hide();
            gridCard.hide();
            
            
            $.ajax({
                url: '/campaign/' + selectedCampaignId + '/emaillog',
                type: 'GET',
                dataType: 'json',
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    
                    $('#emailLogTable tbody').empty();

                    var campaignId = data.campaign_id;
                    var totalSent = data.total_sent;
                    var totalOpened = data.total_opened;
                    
                    loader.hide();
                    dataDisplay.show();
                    emailLogTable.show();
                    gridCard.show();
                    
                    var badgesHtml =
                    '<div class="row">' +
                        '<div class="col-md-3 col-sm-6 col-12">' +
                            '<div class="info-box elevation-1">' +
                                '<span class="info-box-icon bg-primary"><i class="fas fa-bullhorn"></i></span>' +
                                '<div class="info-box-content">' +
                                    '<span class="info-box-text">Campaign </span>' +
                                    '<span class="info-box-number">' + campaignId + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="col-md-3 col-sm-6 col-12">' +
                            '<div class="info-box elevation-1">' +
                                '<span class="info-box-icon bg-success"><i class="fas fa-paper-plane"></i></span>' +
                                '<div class="info-box-content">' +
                                    '<span class="info-box-text">Total Sent</span>' +
                                    '<span class="info-box-number">' + totalSent + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +

                        '<div class="col-md-3 col-sm-6 col-12">' +
                            
                            '<div class="info-box elevation-1" id="openedEmailInfoBox">' +
                                '<span class="info-box-icon bg-warning"><i class="fas fa-envelope-open"></i></span>' +
                                '<div class="info-box-content">' +
                                    '<span class="info-box-text">Opened</span>' +
                                    '<span class="info-box-number">' + totalOpened + '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

    
    $('#dataDisplay').html(badgesHtml);

                    if (data.record.length > 0) {
                               
                                    $.each(data.record, function (index, record) {
                                        var createdAtFormatted = '';
                                        var openedAtFormatted = '';

                                        
                                        if (record.created_at) {
                                            var createdAt = new Date(record.created_at);
                                            if (!isNaN(createdAt.getTime())) {
                                                createdAtFormatted = formatDate(createdAt);
                                            }
                                        }

                                        
                                        if (record.opened_at) {
                                            var openedAt = new Date(record.opened_at);
                                            if (!isNaN(openedAt.getTime())) {
                                                openedAtFormatted = formatDate(openedAt);
                                            }
                                        }

                                        $('#emailLogTable tbody').append(
                                            '<tr>' +
                                            '<td>' + record.recipient_email + '</td>' +
                                            '<td>' + createdAtFormatted     + '</td>' +
                                            '<td>' + openedAtFormatted      + '</td>' +
                                            '</tr>'
                                        );
                                    });
                                } else {
                                    
                                    $('#emailLogTable tbody').append(
                                        '<tr>' +
                                        '<td colspan="3">No data available</td>' +
                                        '</tr>'
                                    );
                                }
                    
                },
                error: function () {
                    alert('No recored found.');
                    loader.hide();
                    dataDisplay.hide();
                    emailLogTable.hide();
                    gridCard.hide();
                }
            });
        });
    });
</script>

@endsection
