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
                  <div class="inputs-size">
                     <div class="inputs-size__item">
                        <p class="label">Length</p>
                        <div class="form3-item-inputs">
                           <input type="number" name="length_ft-1" autocomplete="off" class="inp" placeholder="Ft" required>
                           <input type="number" name="length_in-1" autocomplete="off" class="inp" placeholder="In" required>
                        </div>
                     </div>
                     <div class="inputs-size__item">
                        <p class="label">Width</p>
                        <div class="form3-item-inputs">
                           <input type="number" name="width_ft-1" autocomplete="off" class="inp" placeholder="Ft" required>
                           <input type="number" name="width_in-1" autocomplete="off" class="inp" placeholder="In" required>
                        </div>
                     </div>
                     <div class="inputs-size__item">
                        <p class="label">Height</p>
                        <div class="form3-item-inputs">
                           <input type="number" name="height_ft-1" autocomplete="off" class="inp" placeholder="Ft" required>
                           <input type="number" name="height_in-1" autocomplete="off" class="inp" placeholder="In" required>
                        </div>
                     </div>
                     <div class="inputs-size__item">
                        <p class="label">Weigth</p>
                        <div class="form3-item__last">
                           <input type="number" name="weigth_lbs-1" autocomplete="off" class="inp" placeholder="Lbs" required>
                        </div>
                     </div>
                  </div>
                  <div class="check-wrapper check_wrapper_other">
                     <p class="check-title">
                        Is it operable
                     </p>
                     <div class="check-box">
                        <div class="checkbox-item">
                           <input type="radio" name="is_operable-1" value="Yes" id="is_operable_yes-1" checked="checked">
                           <label for="is_operable_yes-1">Yes</label>
                        </div>
                        <div class="checkbox-item">
                           <input type="radio" name="is_operable-1" value="No" id="is_operable_no-1">
                           <label for="is_operable_no-1">No</label>
                        </div>
                     </div>
                  </div>
                  <div class="check-wrapper check_wrapper_boat">
                     <p class="check-title">
                        Is it on trailer?
                     </p>
                     <div class="check-box">
                        <div class="checkbox-item">
                           <input type="radio" name="is_trailer-1" value="Yes" id="is_trailer_yes-1" checked="checked">
                           <label for="is_trailer_yes-1">Yes</label>
                        </div>
                        <div class="checkbox-item">
                           <input type="radio" name="is_trailer-" value="No" id="is_trailer_no-1">
                           <label for="is_trailer_no-1">No</label>
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