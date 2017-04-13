$(function () {

    $('[data-toggle="tooltip"]').tooltip({
        container: 'body' // Used to fix the bug present for tooltips in button groups, input groups, and table elements
    });

    // Modifies every multiple select input to be a Select2 element
    $('select').select2();

    // Creates a jQuery UI datepicker element
    $('input[id^=datepicker]').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    // Enables an input-group-btn to open the datepicker that it's attached to
    $('input[id^=datepicker] + .input-group-btn > .btn').click(function () {
        $(this).parent().siblings('input[id^=datepicker]').datepicker('show');
    });

    $('#collapse_all').click(function () {
        $('div[id^=collapse_outer]').collapse('hide');
    })

    $('#expand_all').click(function () {
        $('div[id^=collapse_outer]').collapse('show');
    })

});


function ConfirmDelete() {
    return confirm("Are you sure you want to delete?");
}

function ConfirmMessage(message) {
    return confirm(message);
}

if (typeof jQuery.when.all === 'undefined') {
    jQuery.when.all = function (deferreds) {
        return $.Deferred(function (def) {
            $.when.apply(jQuery, deferreds).then(
                function () {
                    def.resolveWith(this, [Array.prototype.slice.call(arguments)]);
                },
                function () {
                    def.rejectWith(this, [Array.prototype.slice.call(arguments)]);
                });
        });
    }
}

Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
   return s + '$' + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
//# sourceMappingURL=app.js.map
