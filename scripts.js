// Add game AJAX
$(document).ready( function() {
    $('#addgame').click(function() {
        var title = document.getElementById('newtitle').value;
        var arr = {'title': title};
        $.post('./includes/addgame.inc.php', arr, function(response) {
            console.log(response);
            if(response['message'] === 'Game added!') {
                $('#admingames').append(`<li>${title}</li>`);
            }
        });
    })
});