function removeAllChildNodes(parent) {
    while(parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
};

// Function to test if any element meets filter
jQuery.fn.any = function(filter) {
    for(i = 0; i < this.length; i++) {
        if( filter.call(this[i])) return true;
    }
    return false;
}

// Sleep function
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
 }
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

$(window).on('load',function() {
    $('#loading').hide();
});

var admin_search = function() {
    // Get query if it exists, else, don't run
    var query = document.getElementById("search-bar");
    if (query) {
        query = query.value;
    }
    else {
        return;
    }
    if (query === '') {
        query = ".*";
    }
    var players = document.getElementById('players');

    // Show loading image while loading
    $('#loading').show();

    // Async post to grab all users matching query
    $.post('./includes/users.inc.php', {'query': query}, function(response) {
        if( response['message'] === 'Success') {
            players.innerHTML = "";

            // Remove all child nodes
            removeAllChildNodes(players);
            // Create table row records and add to DOM
            for(var player of response['content'] ) {
                var row = document.createElement("tr");
                var link = document.createElement('a');
                link.href = './update_user.php?user=' + player['uid'];
                link.target = '_blank';
                link.innerText = player['username'];
                var username = document.createElement("td");
                username.appendChild(link);
                var first_name = document.createElement("td");
                first_name.innerText = player['first_name'];
                var last_name = document.createElement("td");
                last_name.innerText = player['last_name'];

                row.appendChild(username);
                row.appendChild(first_name);
                row.appendChild(last_name);
                players.appendChild(row);
            }
            $('#loading').hide();
        }
    });
}

var searchTimeout;
// Admin player search
<<<<<<< HEAD
$('#search-bar').on('keyup', function(e) {
    if (searchTimeout != undefined) clearTimeout(searchTimeout);
    searchTimeout = setTimeout(admin_search, 300);
});
=======
$('#search-bar').on({keyup: admin_search});
$(window).on('load', admin_search);
>>>>>>> d459187396ae625d4991828a5e574f66753f92e4

window.onload = admin_search;