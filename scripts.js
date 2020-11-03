function removeAllChildNodes(parent) {
    while(parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
};

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
});

// Show leaderboard and grab scores for game
$("#show-leaderboard").click(function() {
    var title = document.getElementById("game-name").value;
    var leaderboard = document.getElementById("leaderboard");
    var header = document.getElementById("lb-header");
    var scores = document.getElementById("lb-scores");

    // Hide leaderboard while changing content
    leaderboard.style.display = "none";
    header.innerHTML = `<h2>${title}</h2>`;

    // Get scores from database post
    $.post('./includes/leaderboards.inc.php', {'title': title}, function(response) {
        if( response['message'] === 'Success') {
            scores.innerHTML = "";
            var i = 1;

            // Remove all child nodes
            removeAllChildNodes(scores);
            // Create table row records and add to DOM
            for(var record of response['content'] ) {
                var row = document.createElement("tr");
                var position = document.createElement("td");
                position.innerText = i;
                var username = document.createElement("td");
                username.innerText = record['username'];
                var score = document.createElement("td");
                score.innerText = record['score'];

                row.appendChild(position);
                row.appendChild(username);
                row.appendChild(score);
                scores.appendChild(row);
                i++;
            }
        }
    });
    leaderboard.style.display = "block";
});