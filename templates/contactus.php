<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHost</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <script src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../images/fav_icon.png" type="image/x-icon">
    <!-- Bulma Version 0.9.0-->
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/contact.css">

</head>

<body>
    <!-- navbar -->
    <?php include('./navbar.php'); ?>


    <section class="section is-medium" style="margin-top: 5%;">

        <div class="container">
            <div class="columns mt-5 is-8 is-variable ">
                <div class="column is-4-tablet is-mobile is-6-desktop">
                    <h1 class="title is-1 is-spaced has-text-centered">GET IN TOUCH</h1><br>
                    <h4 class="subtitle is-5"> We’re very approachable and would love to speak to you. Feel free to call, send us an email,simply complete the enquiry form.</h4>
                    <br>
                    <p><strong>Address&nbsp;:</strong>&nbsp;VHOST,
                        <br>&emsp;&emsp;&emsp;&emsp;&emsp;PLATFORM,
                        <br>&emsp;&emsp;&emsp;&emsp;&emsp;NEW STATION ST,
                        <br>&emsp;&emsp;&emsp;&emsp;&emsp;LEEDS,
                        <br>&emsp;&emsp;&emsp;&emsp;&emsp;LS1 4JB.
                    </p><br>
                    <p><strong>Phone&nbsp;:</strong>&nbsp;0987&nbsp;456&nbsp;123</p><br>
                    <p><strong>Email&nbsp;:</strong>&nbsp;vhostdomain@gmail.com</p>

                </div>
                <div class=" column is-4-tablet is-mobile is-6-desktop">
                    <h1 class="title is-1 is-spaced has-text-centered">SEND US A MESSAGE</h1>
                    <form>
                        <div class="field">
                            <label class="label">Name</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="your name">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" placeholder="Email input" value="" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Message</label>
                            <div class="control">
                                <textarea class="textarea" placeholder="your thoughts ?"></textarea>
                            </div>
                        </div>


                        <div class="field">
                            <div class="control">
                                <button class="button is-link is-fullwidth">Submit &nbsp;
                                    <span class="icon is-small is-left">
                                        <i class="far fa-paper-plane"></i>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><br>
        <br>
        <br>
        <br>
    </section>

    <!--footer-->
    <?php include('./footer.php'); ?>

</body>

</html>