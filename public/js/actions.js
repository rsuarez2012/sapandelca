$(document).ready(function(){
  $('.table').DataTable({
  	language: {
  		lengthMenu: "Mostrar _MENU_ registros por pagina",
  		search:         "Buscar",
  		emptyTable:     "No hay datos registrados",
  		info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros.",
        paginate: {
            first:      "Primero",
            previous:   "Anterior",
            next:       "Proximo",
            last:       "Ultimo"
        }
    }
  });
  $('#example').DataTable();
});