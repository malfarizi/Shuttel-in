<!DOCTYPE html>
<html lang="en">

<!-- Head and CSS -->
@include('admin.templates.head')

<body>
  <div id="app">
    <div class="main-wrapper">      
      <!-- Sidebar -->
      @include('admin.templates.sidebar')
      <!-- Main -->
      @yield('content')
      <!-- Footer -->
      @include('admin.templates.footer')  
    </div>
  </div>

  <!-- Javascript -->
  @include('admin.templates.scripts')
</body>
</html>
