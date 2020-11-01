// Add game AJAX
$(document).ready( function() {
    $('#addgame').click(function() {
        var title = document.getElementById('newtitle').value;
        var arr = {'title': title};
        $.post('./includes/addgame.inc.php', arr, function(response) {
            console.log(response);
            if(response['message'] === 'Game added!') {
                $('#admingames').append(`<li>${title}</li>`);
                document.getElementById('alertMessages').innerHTML = `<p class="alert alert-success">${response["message"]}</p>`
            }
            else {
                document.getElementById('alertMessages').innerHTML = `<p class="alert alert-danger">${response['message']}</p>`;
            }
        });
    })
});

// Game Score Entry Search AJAX
$("#game-name").keyup(function() {
    var title = $(this)[0].value;

    if (title !== '') {
        $.post('./includes/upload.inc.php', {'title': title}, function(response) {
            $('#game-name').autocomplete({
                source: response
            });
        });
    }
});

$("#gamesButtons .row .btn").click(function() {
    var title = $(this)[0].innerText;
    document.getElementById('game-name').value = title;
})