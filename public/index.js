let crashes = document.querySelector('#crashes');

$(document).ready(function() {
    load_data();

    function load_data() {
        $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
                query: 'total'
            },
            success: function(data) {
                crashes.innerHTML = `${data}`;
            }
        });
    }
});