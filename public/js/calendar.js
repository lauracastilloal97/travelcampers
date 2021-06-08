window.onload = () =>{

            var calendarioElt = document.getElementById("calendario");

            var calendario = new FullCalendar.Calendar(calendarioElt,{


                initialView: "dayGridMonth",
                locale: "es",
                timeZone: "Europe/Madrid",
                headerToolbar:{

                    start: "prev, next today",
                    center: "title",
                    end: "dayGridMonth,timeGridWeek"
                },

                events:{


                },


            })

            calendario.render();
}