$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip();

    // Modifies every multiple select input to be a Select2 element
    $('select').select2();

});


function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
}