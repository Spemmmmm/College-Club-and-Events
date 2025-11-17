<script>
function alert(type, msg,position='body') {
            let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
            let element = document.createElement('div');
            element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `;
    
            if(position=='body'){
                document.body.append(element);
                element.classList.add('custom-alert');
            }
            else{
                document.getElementById(position).appendChild(element);
            }
            setTimeout(remAlert, 3000);
        }
    
        function remAlert(){
            document.getElementsByClassName('alert')[0].remove();
        }
</script>


<!-- plugins:js -->
 <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    
    <script src="assets/js/dashboard.js"></script>
   
    
    
    <!-- endinject -->
    <!-- Custom js for this page-->
   
    

  </body>
  
</html>