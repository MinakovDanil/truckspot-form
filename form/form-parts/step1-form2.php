<div id="step-1" class="step-block">
   <div class="step-box">
      <div class="step-nav">
         <div class="step-nav__item active">
            1. Vehicle Information
         </div>
         <div class="step-nav__item">
            2. Origin & Destination
         </div>
         <div class="step-nav__item">
            3. Get Your Quote
         </div>
      </div>
      <div class="step-content">
         <div class="step-content-main">
            <div class="step-content-top">
               <p class="step-of">Step 1 of 3</p>
               <h2>Tell us more about your <span class="selected_transport"></span></h2>
            </div>

            <div class="temp-container">
               <div class="temp-inputs">
                  <div class="selects-box">

                     <!-- Select year -->
                     <div class="select-wrapp">
                        <p class="label">Vehicle year</p>
                        <div class="select-inp select-inp-select2">
                           <select name="vehicle_year-1" id="vehicle_year-1" class="inp select-inp js-select2" required>
                              <option value="" disabled selected hidden></option>
                              <?php get_years(); ?>
                           </select>
                        </div>
                     </div>

                     <!-- Select make -->
                     <div class="select-wrapp">
                        <p class="label">Vehicle make</p>
                        <div class="select-inp select-non-arrow">
                           <input type="text" name="vehicle_make-1" autocomplete="off" class="inp" required>
                        </div>
                     </div>

                     <!-- Select model -->
                     <div class="select-wrapp">
                        <p class="label">Vehicle model</p>
                        <div class="select-inp select-non-arrow">
                           <input type="text" name="vehicle_model-1" autocomplete="off" class="inp" required>
                        </div>
                     </div>

                  </div>
                  <div class="check-container">
                     <!-- Does it run -->
                     <div class="check-wrapper">
                        <p class="check-title">
                           Does it run?
                        </p>
                        <div class="check-box">
                           <div class="checkbox-item">
                              <input type="radio" name="does_run-1" value="No" id="does_run_yes-1" checked="checked">
                              <label for="does_run_yes-1">Yes</label>
                           </div>
                           <div class="checkbox-item">
                              <input type="radio" name="does_run-1" value="Yes" id="does_run_no-1">
                              <label for="does_run_no-1">No</label>
                           </div>
                        </div>
                     </div>
                     <!-- Choose the trailer type -->
                     <div class="check-wrapper">
                        <p class="check-title">
                           Choose the trailer type
                        </p>
                        <div class="check-box">
                           <div class="checkbox-item">
                              <input type="radio" name="trailer_type-1" value="Open" id="trailer_type_open-1" checked="checked">
                              <label for="trailer_type_open-1">Open</label>
                           </div>
                           <div class="checkbox-item">
                              <input type="radio" name="trailer_type-1" value="Enclosed" id="trailer_type_enclosed-1">
                              <label for="trailer_type_enclosed-1">Enclosed</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="remove-btn">
                     Remove
                  </div>
               </div>

            </div>
         </div>
         <div class="step-buttons">
            <button class="add_btn light-btn" type="button">+ Add another vehicle</button>
            <button class="btn1 btn-next btn-form" type="button" aria-controls="step-2">Continue to Step 2</button>
         </div>
      </div>
   </div>
</div>