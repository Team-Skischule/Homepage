
<form class="content-container" id="form" action="" name="contact" >
    <div class="result">  </div>
    
    <div class="form-group row">
        <label for="formVorname" class="col-sm-4 col-form-label">Vorname* </label>
        <input type="text" class="form-control col-sm-8" name="formVorname" id="formVorname"  required>
    </div>
        
    <div class="form-group row">
        <label for="formNachname" class="col-sm-4 col-form-label">Nachname*</label>
        <input type="text" class="form-control col-sm-8" name="formNachname" id="formNachname"minlength="1" required>
    </div>
    
    <div class="form-group row">
        <label for="formMobil" class="col-sm-4 col-form-label">Telefon*</label> 
        <input type="tel" name="phone" id="phone" class="form-control col-sm-8"  placeholder="+1234567890" required>
    </div>
    
    <div class="form-group row">
        <label for="formEmail" class="col-sm-4 col-form-label">Email*</label>
        <input type="email" class="form-control col-sm-8" name="formEmail" id="formEmail" placeholder="test@tester.at" required>
    </div>
    
    <div class="form-group row">
        <label for="formGeburtsdatum" class="col-sm-4 col-form-label">Geburtsdatum*</label>
        <input type="date" class="form-control col-sm-8" name="formGeburtsdatum" id="formGeburtsdatum" required>
    </div>
    
    <div class="form-group row">
        <label for="formLevel" class="col-sm-4 col-form-label">Level* </label>
            <select class="form-control col-sm-8" name="formLevel" id="formLevel" placeholder="Bitte wählen">
                <option value="1">Level-1</option>
                <option value="2">Level-2</option>
                <option value="3">Level-3</option>
                <option value="4">Level-4</option>
                <option value="5">Level-5</option>
            </select>
    </div>

    <div class="form-group row">
        <div class="col-sm-4 col-form-label ">Disziplin*</div>
        <div class="col-sm-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="formSki" id="formSki">
                <label class="form-check-label checkbox-label" for="formSki">Ski</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="formSnowboard" id="formSnowboard">
                <label class="form-check-label checkbox-label" for="formSnowboard">Snowboard</label>
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="formKommentar" class="col-sm-4 col-form-label">Kommentar</label>
        <div class="col-sm-8">
            <textarea id="formKommentar" name="formKommentar" class="form-control" rows="3">
            </textarea>
        </div>
    </div>

    <div class="row">
            <button type="submit" name="submit" class="btn btn-primary"  id="submit_btn" value="Send">Speichern</button>
    </div>
</form>
                    

    <script src="/Homepage/skilehrer-anlegen-process/CreateSkilehrerDbEntry.js" 
        crossorigin="anonymous"></script>

