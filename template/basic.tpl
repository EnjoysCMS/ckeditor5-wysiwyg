<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '{{ selector }}' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>