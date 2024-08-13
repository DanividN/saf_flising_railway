
document.addEventListener('DOMContentLoaded', function() {
    function formatNumber(n) {
        n = String(n).replace(/\D/g, "");
        return n === '' ? n : Number(n).toLocaleString('es-MX');
    }
    document.querySelectorAll('.cantidad').forEach(function(element) {
        element.addEventListener('input', function(e) {
            var value = e.target.value;
            e.target.value = formatNumber(value);
        });
    });
});

$(function() {
    new AutoNumeric('.monto_mantenimiento', {
        decimalPlaces: 2
    });
});