$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip({
        container: 'body' // Used to fix the bug present for tooltips in button groups, input groups, and table elements
    });

    // Modifies every multiple select input to be a Select2 element
    $('select').select2();

    // Creates a jQuery UI datepicker element
    $('#datepicker').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    // Enables an input-group-btn to open the datepicker that it's attached to
    $('#datepicker + .input-group-btn > .btn').click(function () {
        $('#datepicker').datepicker('show');
    });

});


function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
}