  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy;  <a href="">Mailer</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<!-- Your Summernote Initialization -->
<script>
  
    $(document).ready(function() {
        $('#compose-textarea').summernote(
            
        );

    setTimeout(function () {
        var autoHideElements = document.querySelectorAll('.auto-hide');
        autoHideElements.forEach(function (element) {
            element.style.display = 'none';
        });
    }, 5000); // 10 seconds 
        

        
    });

  
</script>
<script>
    $(document).ready(function() {
        // Handle the click event for the "View" button
        $('.view-template').on('click', function() {
            var templateId = $(this).data('template');
            $.ajax({
                url: "{{ route('show-popup') }}", // Update the route
                method: 'GET',
                data: { id: templateId },
                success: function(response) {
                    $('#templateModalLabel').text(response.name);
                    $('#templateModalBody').html(response.content);
                    $('#templateModal').modal('show');
                }
            });
        });
    });
</script>