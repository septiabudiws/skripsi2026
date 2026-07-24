<script data-cfasync="false" src="{{ asset('able') }}/cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/apexcharts.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/jsvectormap.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/world.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/world-merc.js"></script>
    <script src="{{ asset('able') }}/assets/js/widgets/earnings-users-chart.js"></script>
    <script src="{{ asset('able') }}/assets/js/widgets/world-map-markers.js"></script><!--  --><!-- [Page Specific JS] end --><!-- Required Js -->
    <script src="{{ asset('able') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/i18next.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/i18nextHttpBackend.min.js"></script>
    <script src="{{ asset('able') }}/assets/js/icon/custom-font.js"></script>
    <script src="{{ asset('able') }}/assets/js/script.js"></script>
    <script src="{{ asset('able') }}/assets/js/theme.js"></script>
    <script src="{{ asset('able') }}/assets/js/multi-lang.js"></script>
    <script src="{{ asset('able') }}/assets/js/plugins/feather.min.js"></script>

    <script src="{{ asset('able') }}/assets/js/sweetalert2.all.min.js"></script>

    <script src="{{ asset('able') }}/assets/js/jquery.min.js"></script>

    <script src="{{ asset('able') }}/assets/js/datatables.min.js"></script>

    <script>
        layout_change('light');
    </script>
    <script>
        layout_sidebar_change('light');
    </script>
    <script>
        change_box_container('false');
    </script>
    <script>
        layout_caption_change('true');
    </script>
    <script>
        layout_rtl_change('false');
    </script>
    <script>
        preset_change('preset-1');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v4513226cdae34746b4dedf0b4dfa099e1781791509496"
        integrity="sha512-ZE9pZaUXND66v380QUtch/5sE9tPFh2zg45pR2PB0CVkCtOREv2AJKkSidISWkysEuQ0EH8faUU5du78bx87UQ=="
        data-cf-beacon='{"version":"2024.11.0","token":"5980a2e1ef494261848acf01dd801766","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>

    <script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    @endif
</script>
