<form class="content-container" id="form" action="" name="contact" >
    <h1>Neuen Termin Anlegen:</h1>
    <div class="result"></div>
    <div class="form-group row search-box">
        <label for="skilehrername" class="col-sm-3 col-form-label">Skilehrer* </label>
            <input type="text" value="" class="form-control" name="skilehrername" id="skilehrername" autocomplete="off" placeholder="Suche Skilehrer ..." required>
            <div class="skilehrerResult liveSearchResultStyle"></div>
            <div id="skilehrerid"></div>
    </div>

    <div class="form-group row">
        <label for="abholort" class="col-sm-3 col-form-label">Abholort*</label>
        <input type="text" class="form-control" name="abholort" id="abholort"minlength="1" required>
    </div>

    <div class="form-group row">    
        <label for="kundenname" class="col-sm-3 col-form-label">Kunde*</label> 
            <input type="text" name="kundenname" id="kundenname" class="form-control"  required>
    </div>

    <div class="form-group row">
        <label for="beginn" class="col-sm-3 col-form-label">Beginn*</label>
            <input type="date" class="form-control" name="beginn" id="beginn" required>
    </div> 

    <div class="form-group row">
        <label for="ende" class="col-sm-3 col-form-label">Ende*</label>
            <input type="date" class="form-control" name="ende" id="ende" required>
    </div>    

    <div class="row">
            <button type="submit" name="submit" class="btn btn-primary"  id="submit_btn" value="Send">Speichern</button>
    </div>
</form>

