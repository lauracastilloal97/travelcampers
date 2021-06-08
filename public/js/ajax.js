$(document).ready(function() {

    function ocultarComentario(id) {
        $.ajax({
            type: "GET",
            url: "/ocultarComentario",
            data: { idComentario: id },
    

            success: function(data) {
                alert("Comentario eliminado");
            },
            error: function(request, error) {
                console.log(request, error);
            }
        });
    }


    $(".ocultarComentario").on("click",function(){
        ocultarComentario($(this).val());
    });

    

});