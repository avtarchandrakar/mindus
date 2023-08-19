$('#data-list-table table').DataTable( {
					        "fnDrawCallback": function( oSettings ) {
					            CheckPermission(14);
					        }
					    } );