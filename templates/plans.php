<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>VHost</title>

</head>

<body>

    <?php include('./navbar.php'); ?>
    <?php
    include '_dbconnect.php';
    $query = mysqli_query($conn, "SELECT * from plans");
    ?>

    <section class="section is-medium" style="margin-top: 2%;">
        <h3 class="title is-size 4">Plans and pricing</h3>
        <div class="container">
            <div class="columns mt-5 is-8 is-variable">
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                ?>

                    <div class="column is-4-tablet is-3-desktop">
                        <div class="card">
                            <header class="card-header has-text-centered">
                                <p class="card-header-title is-centered" name="plan">
                                    <?php echo $row['plan_title']; ?>
                                </p><br>
                                <p class="card-header-title is-centered" name="amount">
                                    <?php echo $row['ammount']; ?>
                                </p>
                            </header>
                            <div class="card-content">
                                <?php if ($row['plan_id'] == '1010') {
                                    echo
                                    '<div class="content">
                                            <p style="font-size: small;">Low-cost affordable hosting to get you started.</p>
                                            <ul>
                                                <li><b>Standered</b> Performence</li>
                                                <li><b>1</b> Domain</li>
                                                <li><b>10GB</b> Storage</li>
                                                <li><b>unmetered</b> bandwidth</li>
                                                <li>24/7 support</li>
                                            </ul>
                                        </div>';
                                } elseif ($row['plan_id'] == '1020') {
                                    echo
                                    '<div class="content">
                                        <ul>
                                            <li><b>Standered</b> Performence</li>
                                            <li><b>3</b> Domain</li>
                                            <li><b>10</b> SubDomain</li>
                                            <li><b>30GB</b> Storage</li>
                                            <li><b>unmetered</b> bandwidth</li>
                                            <li>24/7 support</li>
                                        </ul>
                                        </div>';
                                } else {
                                    echo
                                    '<div class="content">
                                            <ul>
                                                <li><b>Increased</b> processing power</li>
                                                <li><b>10</b> Domain</li>
                                                <li><b>30</b> SubDomain</li>
                                                <li><b>150GB</b> SSD space</li>
                                                <li><b>unmetered</b> bandwidth</li>
                                                <li>24/7 support</li>
                                            </ul>
                                        </div>';
                                }
                                ?>
                            </div>
                            <?php
                            echo "<footer class='card-footer'>
                                <button type='submit' class='button has-background-primary-dark	is-large is-fullwidth'><a href='./purchase.php?planid=" . $row['plan_id'] . "' class='has-text-white' style='text-decoration:none;'>Buy Now</a></button>
                            </footer>"; ?>
                        </div>
                    </div>
                <?php } ?>

                <div class=" column is-4-tablet is-3-desktop">
                    <div class="card has-background-warning-light">
                        <header class="card-header has-text-centered">
                            <p class="card-header-title is-centered">
                                ENTERPRISE
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <ul>
                                    <br>
                                    pricing not declared
                                    <p><a href="contactus.php">contact us</a>&nbsp;for pricing & more details
                                    </p>
                                    <br>
                                    <br>
                                </ul>
                            </div>
                        </div>
                        <footer class="card-footer">
                            <button class="button has-background-warning  has-text-white  is-large is-fullwidth"><a href="contactus.php" style="color: inherit;text-decoration: none;">Contact</a></button>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('./footer.php'); ?>

</body>

</html>