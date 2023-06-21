<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./homep.css">
    <link rel="stylesheet" href="./footer.css">
    <link rel="stylesheet" type="text/css" href="faq.css" />

    <title>Snap Up</title>
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <main>
        <h2 class="faq-heading">Frequently Asked Questions</h2>
        <p class="description">Checkout our frequently asked questions below. Please feel free to contact us for further queries.</p>
        <section class="faq-container">
            <div class="faq-one">
                <!-- faq question -->
                <h3 class="faq-page">Do you have shipping facility?</h3>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>Sorry, currently we have no any delivery facility. You need to come to the respective store to get your package.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
                <!-- faq question -->
                <h3 class="faq-page">Can the date and time for pick up be changed?</h3>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>Yes, you can change the time and date. However, you need to choose from the given available time and date.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
<h3 class="faq-page">What is your return and exchange policy?</h3>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>All orders cannot be returned. Nonetheless, the orders are exchanged within 2 days of purchase. The items must be in the exact same condition as they were received.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
                <!-- faq question -->
<h3 class="faq-page">What are the available payment methods?</h3>
                <!-- faq answer -->
                <div class="faq-body">
                    <p>For now, the payment can be done only via PayPal. For further queries, please contact us.</p>
                </div>
            </div>
        </section>
    </main>

    <?php
    include('footer.php');
    ?>
    <script>
 var faq = document.getElementsByClassName("faq-page");
var i;
for (i = 0; i < faq.length; i++) {
    faq[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling;
        if (body.style.display === "block") {
            body.style.display = "none";
        } else {
            body.style.display = "block";
        }
    });
}
</script>

</body>

</html>