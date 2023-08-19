@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Groups with Assigned E-mails</h3>
                </div>
                <div class="card-body">
                    @foreach ($groups as $group)
                        <div class="group-card">
                            <h4>{{ $group->group_name }}</h4>
                            <div class="show-emails">
                                <button class="show-emails-btn">
                                    <span class="btn-text">Show Assigned E-mails</span>
                                    <span class="btn-icon">▼</span>
                                </button>
                                <div class="emails-list hidden">
                                    @if ($group->mailsToGroups)
                                        <h4>Assigned E-mails:</h4>
                                        <ul>
                                            @foreach ($group->mailsToGroups as $mailsToGroup)
                                                @foreach (json_decode($mailsToGroup->assign_emails_json) as $email)
                                                    <li>{{ $email }}</li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No assigned e-mails for this group.</p>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Styles -->
<style>
    .group-card {
        margin-bottom: 20px;
    }

    .show-emails-btn {
        cursor: pointer;
        background-color: #f4f4f4;
        border: none;
        padding: 5px 10px;
        display: flex;
        align-items: center;
        width: 100%;
        text-align: left;
    }

    .show-emails-btn:hover {
        background-color: #e0e0e0;
    }

    .btn-icon {
        margin-left: auto;
        transition: transform 0.3s ease-in-out;
    }

    .show-emails-btn.collapsed .btn-icon {
        transform: rotate(-90deg);
    }

    .emails-list {
        margin-top: 10px;
    }

    .hidden {
        display: none;
    }
</style>

<!-- JavaScript -->
<script>
    const showButtons = document.querySelectorAll('.show-emails-btn');
    showButtons.forEach(button => {
        button.addEventListener('click', () => {
            const emailsList = button.nextElementSibling;
            emailsList.classList.toggle('hidden');
            button.classList.toggle('collapsed');
        });
    });
</script>
@endsection
