<div id="step-3" class="step-block">
   <div class="step-box">
      <div class="step-nav">
         <div class="step-nav__item completed">
            1. Vehicle Information
         </div>
         <div class="step-nav__item completed">
            2. Origin & Destination
         </div>
         <div class="step-nav__item active">
            3. Get Your Quote
         </div>
      </div>
      <div class="step-content">
         <div class="step-content-main">
            <div class="step-content-top">
               <p class="step-of">Step 3 of 3</p>
               <h2>Give us info on where to send your quotes!</h2>
               <p class="step-subtitle">Your privacy means everything to us!</p>
            </div>
            <div class="inp-item">
               <p class="label">My Name</p>
               <input type="text" name="full_name" class="inp" required>
            </div>
            <div class="inp-item">
               <p class="label">My Email</p>
               <div class="info-wrapp">
                  <input type="email" name="email" id="email" class="inp" required>
                  <label for="email" class="email-info">
                     <div class="info info-right"><img alt="Info" src="<?php echo get_template_directory_uri(); ?>/form/assets/images/info.svg"><span>Please enter a valid email address</span></div>
                  </label>
               </div>
            </div>
            <div class="inp-item">
               <p class="label">My Phone</p>
               <div class="info-wrapp">
                  <input type="text" name="phone" id="phone" autocomplete="off" class="inp inpPhone" required>
                  <label for="phone" class="phone-info">
                     <div class="info info-right"><img alt="Info" src="<?php echo get_template_directory_uri(); ?>/form/assets/images/info.svg"><span>Please enter a valid US phone number</span></div>
                  </label>
               </div>
            </div>
         </div>

         <div class="step-buttons">
            <button class="btn-prev light-btn" type="button" aria-controls="step-2">← Back</button>
            <button class="btn1 btn-form" type="submit">View Instant Quotes</button>
         </div>
      </div>
   </div>
</div>