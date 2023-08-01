<?php
/* Template Name: Form */


get_header(); ?>

<div class="form-container">
    <div class="select-container">
        <h1 class="page-form-title" id="vehicle_title">Select Vehicle Shipping Category</h1>
        <div class="select-vehicle">
            <div class="select-vehicle__item" data-form="form1">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/car-shipping.svg" alt="Car shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Car">Car</div>
            </div>
            <div class="select-vehicle__item" data-form="form2">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/motorcycle-shipping.svg" alt="Motorcycle shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Motorcycle">Motorcycle</div>
            </div>
            <div class="select-vehicle__item" data-form="form3">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/trailer-shiping.svg" alt="Trailer shiping">
                <hr>
                <div class="select_vehicle_title" data-title="Trailer">Trailer</div>
            </div>
            <div class="select-vehicle__item" data-form="form3">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/boat-shipping.svg" alt="Boat shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Boat">Boat</div>
            </div>
            <div class="select-vehicle__item" data-form="form2">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/atv-utv-shipping.svg" alt="ATV/UTV shipping">
                <hr>
                <div class="select_vehicle_title" data-title="ATV/UTV">ATV/UTV</div>
            </div>
            <div class="select-vehicle__item" data-form="form3">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/truck-shipping.svg" alt="Truck shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Truck">Truck</div>
            </div>
            <div class="select-vehicle__item" data-form="form3">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/forklift-shipping.svg" alt="Forklift shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Forklift">Forklift</div>
            </div>
            <div class="select-vehicle__item" data-form="form2">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/snowmobile-shipping.svg" alt="Snowmobile shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Snowmobile">Snowmobile</div>
            </div>
            <div class="select-vehicle__item" data-form="form3">
                <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/heavy-equipment-shipping.svg" alt="Heavy Equipment shipping">
                <hr>
                <div class="select_vehicle_title" data-title="Heavy Equipment">Heavy Equipment</div>
            </div>
        </div>
        <div class="vehicle-shipping">

            <!-- Form1 - Car -->
            <div class="multi-step-form" id="form1">
                <form method="POST">
                    <input type="hidden" name="vehicle_type" value="">
                    <input type="hidden" name="form_type" value="form_type_1">
                    <!-- Step 1 -->
                    <?php require get_template_directory() . '/form/form-parts/step1-form1.php';
                    ?>

                    <!-- Step 2 -->
                    <?php require get_template_directory() . '/form/form-parts/step2.php'; ?>

                    <!-- Step 3 -->
                    <?php require get_template_directory() . '/form/form-parts/step3.php'; ?>
                </form>
            </div>
            <!-- Form2 - ATV/UTV, Motorcycle, Snowmobile  -->
            <div class="multi-step-form" id="form2">
                <form method="POST">
                    <input type="hidden" name="vehicle_type" value="">
                    <input type="hidden" name="form_type" value="form_type_2">
                    <!-- Step 1 -->
                    <?php require get_template_directory() . '/form/form-parts/step1-form2.php'; ?>

                    <!-- Step 2 -->
                    <?php require get_template_directory() . '/form/form-parts/step2.php'; ?>

                    <!-- Step 3 -->
                    <?php require get_template_directory() . '/form/form-parts/step3.php'; ?>
                </form>
            </div>

            <!-- Form3 - Boat and Other  -->
            <div class="multi-step-form" id="form3">
                <form method="POST">
                    <input type="hidden" name="vehicle_type" value="">
                    <input type="hidden" name="form_type" value="form_type_3">
                    <!-- Step 1 -->
                    <?php require get_template_directory() . '/form/form-parts/step1-form3.php'; ?>

                    <!-- Step 2 -->
                    <?php require get_template_directory() . '/form/form-parts/step2.php'; ?>

                    <!-- Step 3 -->
                    <?php require get_template_directory() . '/form/form-parts/step3.php'; ?>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Form submit -->
<div class="form-success">
    <div class="form-success-wrapper">
        <img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/success.svg" alt="Success">
        <p class="thanks-title">Thank you!</p>
        <p class="thanks-text">Your submission has been sent.</p>
    </div>
</div>


<div id="form_loader">
    <div id="gear"><img src="<?php echo get_template_directory_uri(); ?>/form/assets/images/gear.svg" alt="Gear"></div>
</div>

<?php get_footer();
