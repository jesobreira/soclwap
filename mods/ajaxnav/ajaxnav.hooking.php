<?php
global $home;
swhead('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript"> 
    // Thanks to William Bruno
    // www.wbruno.com.br 
    $(document).ready(function(){  
        $("a").live(\'click\', function( e ){
            e.preventDefault();  
            var href = $( this ).attr(\'href\');
            if( $( this ).attr(\'target\')==\'_blank\' ) {
            window.open( href );
            } else {
            anchor = href.replace(\''.$home.'\', \'\');
            location.href = "#/"+anchor;
            $("#page").load( href +" #page");  
            }
        });  
    });  
    </script> ');