
<style>
      #loadingSpinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }
        .spinner-border {
            width: 3rem;
            height: 3rem;
            border-width: .4em;
            border-radius: 50%;
            border-top-color: #3e0fd8;
            border-left-color: transparent;
            border-bottom-color: transparent;
            border-right-color: transparent;
            animation: spinner-border .75s linear infinite;
        }
        @keyframes spinner-border {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

<div id="loadingSpinner" class="d-flex justify-content-center align-items-center">
    <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded');
        document.getElementById('loadingSpinner').style.display = 'flex';
    });

    window.addEventListener('load', function() {
        console.log('Window Loaded');
        document.getElementById('loadingSpinner').style.display = 'none';
    });
</script>