@include('admin.blocks.header')
<div class="container body">
    <div class="main_container">
        
        @include('admin.blocks.sidebar')
        

        <div class="right_col">
            
            @include('admin.partials.list-khuyenmai') 
            

    </div>
</div>
<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
@include('admin.blocks.footer')