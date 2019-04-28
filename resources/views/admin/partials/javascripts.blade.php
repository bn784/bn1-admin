<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="{{ asset('js/admin.js') }}" defer></script>

<script>
//sidebar
$('.bn-toggle').click(function(e){
    if( $(this).next('ul').hasClass('active') ){
        $(this).next('ul').removeClass('active').children('li').slideUp();
        e.stopPropagation();
    }
    else{
        $(this).next('ul').addClass('active').children('li').slideDown();
        e.stopPropagation();
    }
});

</script>
