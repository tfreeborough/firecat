<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.0.0/fuse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"/>

<!-- DatePicker -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

<!-- Add Vex -->
<script src="/js/vex.combined.min.js"></script>
<script>vex.defaultOptions.className = 'vex-theme-os'</script>
<link rel="stylesheet" href="/css/vex.css" />
<link rel="stylesheet" href="/css/vex-theme-os.css" />

<!-- Add Dropzone -->
<script src="/js/dropzone.js"></script>

<!-- Spectrum Colorpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css" />

<!-- Cloudinary jQuery -->
<script src="https://cdn.jsdelivr.net/jquery.cloudinary/1.0.18/jquery.cloudinary.min.js"></script>
<script>
    $.cloudinary.config({ cloud_name: '{{ env('CLOUDINARY_CLOUD_NAME') }}' });
</script>

<!-- Linkify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-linkify/2.1.4/linkify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-linkify/2.1.4/linkify-jquery.min.js"></script>

@yield('scripts')