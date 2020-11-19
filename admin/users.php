<?php
    require_once 'header.php';

    require_once '../composer/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

?>
<h1>Players in System</h1>
<hr/>
<h4>Click on a username to edit a profile</h4>
<div id="player-search">
    <div class="row form-inline" style="padding-bottom: 10px;">
        <label class="form-label col-sm-2" for="search-bar">Search</label>
        <input class="form-control col-sm-4" id="search-bar" type="text">
    </div>
</div>
<div id="players-table">
    <div id="loading">
        <img id="loading-image" src="https://media4.giphy.com/media/3y0oCOkdKKRi0/giphy.gif?cid=ecf05e47gk600u9thwmt1wi5k2asbisuxid3ku93tp8nh7vj&rid=giphy.gif" alt="Loading...">
    </div>
    <div id="pl-header">
    </div>
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
            </tr>
        </thead>
        <tbody id="players">
        </tbody>
    </table>
</div>
<?php
    require_once 'footer.php';

?>