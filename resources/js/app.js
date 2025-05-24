import './bootstrap';
import $ from 'jquery';
import 'datatables.net'; // versi default, tanpa bootstrap
import 'datatables.net-dt/css/dataTables.dataTables.css';
 // CSS default DataTables

$(function () {
  $('#example').DataTable();
});

window.$ = $;
window.jQuery = $;
