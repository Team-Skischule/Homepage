<div id="myModal" class="modalbox modalbox-itemPopup">
                        <!-- Modal content -->
                        <div class="modalbox-content" id="testme">
                            <span class="close">&times;</span>

                            <form class="content-container" id="formpopup" action="" name="contact">
                                <h2>Termin bearbeiten</h2>
                                <div class="resultpopup"></div>
                                <div class="form-group row search-box live-search-popup">
                                    <label for="skilehrername" class="col-sm-4  col-form-label">Skilehrer:</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="text" value="" class="form-control" name="skilehrername" id="skilehrernamepopup" autocomplete="off" placeholder="Suche Skilehrer ..." required>
                                        <div class="skilehrerResult liveSearchResultStyle skilehrerResultPopup skilehrerResultNeuTermin"></div>
                                        <div class="skilehrer-id-popup" id="skilehrer-id-popup" data-value="" hidden></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kundenname" class="col-sm-4  col-form-label">Kunde</label>
                                    <input type="text" name="kundenname" id="kundennamepopup" class="form-control col-sm-8" required>
                                </div>

                                <div class="form-group row">
                                    <label for="abholort" class="col-sm-4  col-form-label">Abholort</label>
                                    <input type="text" class="form-control col-sm-8" name="abholort" id="abholortpopup" minlength="1" required>
                                </div>

                                <div class="form-group row">
                                    <label for="beginn" class="col-sm-4  col-form-label">Beginn</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="date" class="form-control" name="beginn" id="datumbeginnpopup" required>
                                        <div id="livesearch"></div>
                                        <div id="livesearchbeginn"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ende" class="col-sm-4  col-form-label">Ende</label>
                                    <div class="col-sm-8 specialFieldFullWidth">
                                        <input type="date" class="form-control" name="ende" id="datumendepopup" value="" required>
                                        <div id="livesearch"></div>
                                        <div id="livesearchende"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Dropdown Status ändern -->
                                    <label for="statuspopup" class="col-sm-4 col-form-label">Status</label>
                                    <select class="form-control col-sm-8" name="statuspopup" id="statuspopup" placeholder="Bitte wählen">
                                        <option value="item-status-none">OK</option>
                                        <option value="item-status-one">Rückmeldung</option>
                                        <option value="item-status-two">Abgelehnt</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <button type="submit" name="submit" class="btn btn-primary" id="submit_btnpopup" value="Send">Speichern</button>
                                </div>
                                <div class="row">
                                    <button id="deleteTermin" class="btn btn-primary deleteTermin">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>