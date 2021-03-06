 <div>
     <form class="content-container neu-termin-anlegen" id="form" action="" name="contact">
         <h2>Termin anlegen</h2>
         <div class="result"></div>
         <div class="form-group row search-box">
             <label for="skilehrername" class="col-sm-4  col-form-label">Skilehrer* </label>
             <div class="col-sm-8 specialFieldFullWidth">
                 <input type="text" value="" class="form-control" name="skilehrername" id="skilehrername" autocomplete="off" placeholder="Suche Skilehrer ..." >
                 <div class="skilehrerResult skilehrerResultNeuTermin liveSearchResultStyle"></div>
                 <div id="skilehreridNeuTermin" hidden></div>
             </div>
         </div>

         <div class="form-group row">
             <label for="kundenname" class="col-sm-4  col-form-label">Kunde*</label>
             <input type="text" name="kundenname" id="kundennameNeuTermin" class="form-control col-sm-8" required>
         </div>

         <div class="form-group row">
             <label for="abholort" class="col-sm-4  col-form-label">Abholort*</label>
             <input type="text" class="form-control col-sm-8" name="abholort" id="abholortNeuTermin" minlength="1" required>
         </div>

         <div class="form-group row">
             <label for="beginn" class="col-sm-4  col-form-label">Beginn*</label>
             <div class="col-sm-8 specialFieldFullWidth">
                 <input type="date" class="form-control" name="beginn" id="beginnNeuTermin" required>
                 <div id="livesearch"></div>
                 <div id="livesearchNeuTerminBeginn"></div>
             </div>
         </div>

         <div class="form-group row">
             <label for="ende" class="col-sm-4  col-form-label">Ende*</label>
             <div class="col-sm-8 specialFieldFullWidth">
                 <input type="date" class="form-control" name="ende" id="endeNeuTermin" required>
                 <div id="livesearch"></div>
                 <div id="livesearchNeuTerminEnde"></div>
             </div>
         </div>

         <div class="row">
             <button type="submit" name="submit" class="btn btn-primary terminxxx" id="submit_btnNeuTermin" value="Send">Speichern</button>
         </div>
     </form>

     <reference path=/Homepage/TimeScheduler-master/js/calendar.js" />

     <script>
         /* mit Klick auf "Speichern"-Button werden die Kalender Items neu geladen */
         document.getElementById("submit_btnNeuTermin").addEventListener("click", reloadCalenderItems);

         function reloadCalenderItems() {
             setTimeout(() => {
                 console.log('reload aufgerufen')
                 getItemsTest();
             }, 1000);
         }
     </script>
 </div>