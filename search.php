<?php
    require_once 'header.php';

    $searchOptions = ['players', 'games']
?>
    <h1>Search</h1>
    <p>Please select what category you would like to search and what you would like to search for in the category</p>
    <form method="POST">
        <div class="form-group row">
            <label for="searchInput" class="col-md-1 col-form-label">Search</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search">
            </div>
            <div class="col-md-2">
                <select class="form-control">
                    <option selected>Choose...</option>
                    <?php
                        foreach($searchOptions as $option) {
                            echo "<option>$option</option>";
                        }
                    ?>

        </div>

    </form>
<?php
    require_once 'footer.php';
?>