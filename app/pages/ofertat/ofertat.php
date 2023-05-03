<?php

// Random unique ID
$uniqe = date('dmY') . rand(0000, 9000);

$emriProduktit = "";




$_SESSION['row'][] = [$_POST['submit']];
// $row[] = $_SESSION['row'];
// $_SESSION['row'] = $row;
// Prezemi nalog
if (isset($_POST['submit'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
    $emriProduktit = htmlspecialchars(($_POST['emriProduktit']));

    $sql = "SELECT * FROM produktet WHERE emriProduktit = '$emriProduktit' AND isDeleted = 0";

    $result = $link->query($sql);

    $row = $result->fetch_assoc();

    array_push($_SESSION['row'], $_POST);

    if (mysqli_num_rows($result) < 1) {
        $_SESSION['error'] = "nuk ekziston";
    }
}
?>

<div class="container-fluid">

    <!-- Header Title START -->
    <div class="pt-3 pb-2 d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h2><i class="fas fa-faucet fa-fw"></i>
            <?php echo $replaceTitle ?? 'Krijo Pagese' ?>
        </h2>
    </div> <!-- Header Title END -->

    <!-- Display Session Messages-->
    <?php echo session_message(); ?>

    <section class="card my-3">
        <header class="card-header">
            <span class="error"><?php echo $lang['Fusha_te_detyrueshme'] ?? "* Fusha të detyrueshme"; ?></span>
        </header>
        <div class="container-fluid">
            <!-- Control the column width, and how they should appear on different devices -->
            <div class="row">
                <div class="col-sm-8 mt-4">
                    <div class="card">
                        <h4 class="text-center my-3 pb-3">To Do App</h4>

                        <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="POST">
                            <div class="col-6">
                                <div class="form-outline">

                                    <!-- <label for="dlist" class="control-label"><?php echo $lang['produktet_list'] ?? "produktet *"; ?></label> -->
                                    <input list="plist" id="emriProduktit" name="emriProduktit" class="form-control" value="<?php echo $emriProduktit; ?>" autocomplete="off">
                                    <?php
                                    echo '<datalist id="plist">';
                                    $produktet = getProduktet();
                                    foreach ($produktet as $produkt) {
                                        echo "<option value='$produkt[emriProduktit]'></option>";
                                    }
                                    echo "</datalist>";
                                    ?>

                                </div>
                            </div>
                            <div class="col-1">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-warning">save</button>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped table-sm table-hover text-center">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (isset($_SESSION['row'])) {
                                        $nr = 0;
                                        foreach ($_SESSION['row'] as $product) {
                                            $nr++;

                                    ?>
                                            <tr>

                                                <td><?php echo $product['emriProduktit'] ?? ''; ?></td>

                                                <!-- <td>In progress</td> -->
                                                <td>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    <button type="submit" class="btn btn-success ms-1">Finished</button>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <?php
                            // print_r($_SESSION['row']);
                            // die;
                            ?>
                        </div>
                    </div>
                </div><!-- card-body END -->

                <?PHP

                ?>
                <div class="col-sm-4 mt-4">
                    <div class=" card">
                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-4 pt-0">Radios</legend>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                First radio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                                            <label class="form-check-label" for="gridRadios2">
                                                Second radio
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                                            <label class="form-check-label" for="gridRadios3">
                                                Third disabled radio
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-sm-4">Checkbox</div>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                                        <label class="form-check-label" for="gridCheck1">
                                            Example checkbox
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- card END -->
</div> <!-- container END -->