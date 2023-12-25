 <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">
                      Home / Dashboard
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
            <div class="col-5 align-self-center">
              <div class="float-right">
                <!-- Mengganti button tanggal menjadi search tanggal di halaman list penjualan -->
                <button type="button" class="btn btn-primary btn-rounded" id="currentDateTimeButton">
                  <i class="fas fa-calendar"></i> &nbsp;<span id="currentDateTime"></span>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <script>
        // JavaScript code to update the date and time dynamically
        function updateDateTime() {
          var currentDate = new Date();
          var options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: 'numeric', minute: 'numeric', second: 'numeric' };
          var formattedDate = currentDate.toLocaleDateString('en-US', options);

          document.getElementById('currentDateTime').innerText = formattedDate;
        }

        // Call the function on page load
        updateDateTime();

        // Update the date every second (adjust as needed)
        setInterval(updateDateTime, 1000);
        </script>