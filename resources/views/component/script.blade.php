<script src="../../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../../assets/vendor/libs/popper/popper.js"></script>
<script src="../../assets/vendor/js/bootstrap.js"></script>
<script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../../assets/vendor/libs/hammer/hammer.js"></script>
<script src="../../assets/vendor/libs/i18n/i18n.js"></script>
<script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="../../assets/vendor/js/menu.js"></script>
<script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="../../assets/vendor/libs/swiper/swiper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/scripts/verify.min.js"></script>
<!-- Main JS -->
<script src="../../assets/js/main.js"></script>
<!-- Page JS -->
<script src="../../assets/js/dashboards-analytics.js"></script>
<script>
    function formatPhoneNumber() {
        let input = document.getElementById('phone-number-mask');
        let value = input.value.replace(/\D/g, '');

        // Add space every 4 characters
        let formattedValue = value.replace(/(\d{4})(?=\d)/g, '$1 ');

        input.value = formattedValue.trim(); // Trim any leading/trailing spaces
    }
</script>
