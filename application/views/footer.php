
  <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url();?>assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->

    <!-- Data table plugin-->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/dataTables.bootstrap.min.js"></script>


<script type="text/javascript">

    $(document).ready(function() {
    $('#calendar').fullCalendar({

    eventClick:  function(event, jsEvent, view) {

                var param = {
                    id_actividad: event.id_actividad
                 };  
                $.ajax({
                   url: "http://localhost/invet/actividad/servicios_ajax",
                   type: "post",
                   data: param,
                   success: function(data) {
                        $('#modalTitle').html(event.title);
                        $('#eventUrl').attr('href',event.url);
                        $('#modalBody').html(event.description+data);
                         if(event.finalizada==false)
                         {
                            $('#botonfinalizar').html('<a class="btn btn-success"  href="http://localhost/invet/actividad/finalizar/'+event.id_actividad+'" type="button">finalizar</a>');
                          }
                        else
                        {
                          $('#botonfinalizar').html('');
                        }
                          
                        $('#calendarModal').modal();
                    }
                });      
        },
        header: {
        center: 'month,listWeek,listDay ' // buttons for switching between views
    },
        editable: true,

eventDrop: function(event, delta, revertFunc) {
  if(event.finalizada==true)
   {
    alert ("Evento finalizado, no se puede modificar");
    revertFunc();
   }
   else{
       $("#modal_confirm_yes_no").dialog({
            bgiframe: true,
            autoOpen: false,
            minHeight: 200,
            width: 550,
            modal: true,
            closeOnEscape: false,
            draggable: false,
            resizable: false,
           open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
            },
            buttons: {
                    'Aceptar': function(){
                        
                      
                         var param = {
                                id_actividad: event.id_actividad,
                                fecha: event.start.format(),
                                motivo: $( "#motivo" ).val(),
                            };
                             $.ajax({
                                   url: "http://localhost/invet/actividad/editar_ajax",
                                   type: "post",
                                   data: param,
                                    success: function(data) {
                                    
                                    
                                    }
                                });
                              $(this).dialog('close');
                    },
                    'Cancelar': function(){
                        $(this).dialog('close');
                         revertFunc();
                    }
                },
       
        });

        var answer = $("#modal_confirm_yes_no").dialog("open");
       
}
      
       
    },    
        views: {
        listDay: { buttonText: 'Dia' },
        listWeek: { buttonText: 'Semana' }
        },
        eventSources: [
            { 
                events: function(start, end, timezone, callback) {
                 $.ajax({
                 url: '<?php echo base_url();?>/actividad/get_events',
                 dataType: 'json',
                 data: {
                 // our hypothetical feed requires UNIX timestamps
                 start: start.unix(),
                 end: end.unix()
                 },
                 success: function(msg) {
                     var events = msg.events;
                     callback(events);
                 }
                 });
             }
            }
        ]
});
});
</script>
 <!-- Page specific javascripts-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/moment.min.js"></script>
<script src="<?php echo base_url();?>assets2/fullcalendar/dist/fullcalendar.js"></script>
<script src='<?php echo base_url();?>assets2/fullcalendar/dist/locale/es.js'></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/fullcalendar.custom.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
  


<!--  Tables - Use for reference -->

 <script>
    $(document).ready(function() {
       
           $('#sampleTable').DataTable( {

        
  language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
    

   
} );
} );
</script>

    <script>
    $(document).ready(function() {
        $('#dataTables_actividades').dataTable(
            {
                 responsive: true,

                "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
    },

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
           "url": "<?php echo base_url();?>/actividad/ajax_list",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
    }
    );
    });
    </script>

<script type="text/javascript">

 var seleccionado=<?php echo set_value('id_obra'); ?>
$(function(){
    var fillSecondary = function(){
        var selected = $('#primary').val();
        $('#secondary').empty();
        $.getJSON("<?php echo base_url();?>cliente/sucursal/"+selected,null,function(data){
           data.forEach(function(element,index){
            var sel="";
            if(element[1]==seleccionado)
                {
                    sel="selected";
                }
              $('#secondary').append('<option value="'+element[1]+'" '+sel+'>'+element[0]+'</option>');            
           });
        });
    }
    $('#primary').change(fillSecondary);
    fillSecondary();
});
</script>


  

    
  </body>
</html>
