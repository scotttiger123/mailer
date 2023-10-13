@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content" style="padding-top: 20px;">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Groups Details</h3>
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
                    @if ($groups->isEmpty())
                        <div class="alert alert-info">    
                                No groups available.
                        </div>    
                    @else 
                    @foreach ($groups as $group)
                        <div class="group-card">
                            <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-bold text-primary">{{ $group->group_name }}</h4>
                                </button>
                                   <div>
                                    <!-- Edit Group Button -->
                                    <button
                                            type="button"
                                            class="btn btn-primary"
                                            data-toggle="modal"
                                            data-target="#editGroupModal"
                                            data-groupid="{{ $group->id }}"
                                            data-groupname="{{ $group->group_name }}"
                                            data-assignedemails="{{ htmlspecialchars(implode(' ', array_merge(...array_map('json_decode', $group->mailsToGroups->pluck('assign_emails_json')->flatten()->toArray()))) ) }}"




                                        >
                                            Edit
                                        </button>

                                        <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editGroupModalLabel">Edit Group Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <form action="{{ route('groups.update') }}" method="POST">

                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <!-- Hidden input for group ID -->
                                                            <input type="hidden" id="editGroupId" name="editGroupId" value="">

                                                            <!-- Edit Group Name -->
                                                            <div class="form-group">
                                                                <label for="editGroupName">Group Name</label>
                                                                <input type="text" class="form-control" id="editGroupName" name="editGroupName" required>
                                                            </div>

                                                            <!-- Edit Assigned Emails -->
                                                            <div class="form-group">
                                                                <label for="editAssignedEmails">Assigned Emails</label>
                                                                <textarea class="form-control" id="editAssignedEmails" name="editAssignedEmails" rows="4"></textarea>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <form action="{{ route('groups.delete', $group->id) }}" method="POST" style="display: inline;padding-bottom:15px;" id="deleteForm-{{ $group->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete(event)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="show-emails">
                                <div class="emails-list hidden">
                                    @if ($group->mailsToGroups->count() > 0)
                                        <div>
                                            @foreach ($group->mailsToGroups as $mailsToGroup)
                                                @foreach (json_decode($mailsToGroup->assign_emails_json) as $email)
                                                    @if (trim($email) !== '')
                                                        <span class="badge badge-secondary">{{ $email }}</span>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    @else
                                        <p>No assigned e-mails for this group.</p>
                                    @endif
                                </div>

                            </div>
                            <hr>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Group Modal -->


<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmDelete(event) {
        if (confirm("Are you sure you want to delete this group?")) {
            return true;
        } else {
            event.preventDefault(); // Prevent form submission
            return false;
        }
    }

    const showButtons = document.querySelectorAll('.show-emails-btn');
    showButtons.forEach(button => {
        button.addEventListener('click', () => {
            const emailsList = button.nextElementSibling;
            emailsList.classList.toggle('hidden');
            button.classList.toggle('collapsed');
        });
    });

    
// Handle Edit Group Modal
$(document).ready(function() {
    $('#editGroupModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var groupId = button.data('groupid');
        var groupName = button.data('groupname');
        var assignedEmails = button.data('assignedemails');
        console.log(assignedEmails);
        if (Array.isArray(assignedEmails)) {
            // Flatten the array and join the elements with commas
            var emailString = assignedEmails.flat();
        } else {
            // If it's not an array, treat it as a single email
            var emailString = assignedEmails;
        }

        var modal = $(this);
        modal.find('#editGroupId').val(groupId);
        modal.find('#editGroupName').val(groupName);
        modal.find('#editAssignedEmails').val(emailString);
    });
});


    $(document).ready(function() {
        $('.show-emails-btn').click(function() {
            $(this).find('.btn-icon').toggleClass('collapsed');
            $(this).next('.emails-list').toggleClass('hidden');
        });
    });
</script>
@endsection
