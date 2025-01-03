@include('admin.layout.sidebar')
<div class="wrapper d-flex flex-column min-vh-100">
    <main class="main-content flex-grow-1 position-relative border-radius-lg">
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        @include('admin.layout.footer')
    </footer>
</div>
