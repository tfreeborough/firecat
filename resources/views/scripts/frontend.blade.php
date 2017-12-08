<script src="/js/particles.min.js"></script>
<script>
    window.onload = function(){
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particles-js', '/css/particles.json', function() {
            console.log('callback - particles.js config loaded');
        });
    };

</script>