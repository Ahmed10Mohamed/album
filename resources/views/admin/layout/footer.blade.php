            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                >
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                  </div>
                  <div>

                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('backend/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('backend/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/node-waves/node-waves.js')}}"></script>

    <script src="{{asset('backend/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/moment/moment.js')}}"></script>

    <script src="{{asset('backend/vendor/js/menu.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables-responsive/datatables.responsive.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables-buttons/datatables-buttons.js')}}"></script>
    <script src="{{asset('backend/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js')}}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('backend/vendor/libs/apex-charts/apexcharts.js')}}"></script>


    <!-- Main JS -->
    <script src="{{asset('backend/js/main.js')}}"></script>
<!-- Include jQuery -->

<!-- Include FilePond CSS -->
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

<!-- Include FilePond JS -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<!-- Optional FilePond Plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">


@yield('script')

    <!-- Core JS -->
<script type="text/javascript" src="{{asset('js/toaster.js')}}"></script>
    <!-- BEGIN PAGE LEVEL JS-->
    @if(session()->has('success') )
            <script>toastr.success('{{ session()->get("success") }}')</script>


            @endif
            @if(session()->has('fail') || $errors->any() )

            <script>
            let failMessage = "{{ $errors->first() ?: session()->get('fail') }}" ;
            let failTitle = "حدث خطا"
            toastr.error(failMessage, failTitle);
            </script>


            @endif


  </body>
</html>

