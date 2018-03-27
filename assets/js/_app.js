//var $ = require('jquery');
// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
//require('bootstrap-sass');

require('../css/template/jquery/jquery.min');
require('../css/template/bootstrap/js/bootstrap.bundle.min');
require('../css/template/jquery-easing/jquery.easing.min');
require('../css/template/chart.js/Chart.min');
require('../css/template/datatables/jquery.dataTables');
require('../css/template/js/sb-admin-charts.min');
//require('../css/template/datatables/dataTables.bootstrap4');
require('../css/template/js/sb-admin.min');
require('../css/template/js/sb-admin-datatables');
$(document).ready(function() {
   // $('[data-toggle="popover"]').popover();

    $('#deleteUserModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        $(this).find('form').attr('action', button.data('href'));
    })
});

