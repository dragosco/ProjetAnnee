  <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

          <div class="col-md-12">
              <br>
              <button class="btn btn-default btn-block" type="button" name="submit" id="addTaskButton">
                  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add Task</button>
          </div>
          <!-- Le paramètrage de la tâche est initialement caché -->
          <div class="row" id="taskConfig">
              <div class="row">
                  <div class="col-md-12"><input class="form-control" id="taskInput" type="text" name="taskName" placeholder="Task name" /></div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-6 ">
                      <fieldset class="form-group">
                          <label class="formLabel" for="leftTaskSelector">Follows</label>
                          <select class="form-control" id="leftTaskSelector" data-toggle="tooltip" data-placement="right" title="Choose the task(s) it follows <br/> [Ctrl + Select] for multiple choices"multiple>
                              <option>Start</option>
                          </select>
                      </fieldset>
                  </div>
                  <div class="col-md-6">
                      <fieldset class="form-group">
                          <label class="formLabel" for="rightTaskSelector">Precedes</label>
                          <select class="form-control" id="rightTaskSelector" data-toggle="tooltip" data-placement="right" title="Choose the task(s) it precedes <br/> [Ctrl + Select] for multiple choices" multiple>
                              <option>End</option>
                          </select>
                      </fieldset>
                  </div>
              </div>
              <br>
              <div class="col-md-12">
              <div class="row">
                  <label class="formLabel" for="probaLawBtnGroup">Probability Law</label>
              </div>
              </div>
              <div class="col-md-12 btn-group btn-group-justified" data-toggle="buttons" id="probaLawBtnGroup">
                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-law" value="1">υ</button>
                      </div>
                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-law" value="2">β</button>
                      </div>
                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-law" value="3">Λ</button>
                      </div>
                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-law" value="4">σ</button>
                      </div>
                      <div class="btn-group">
                          <button type="button" class="btn btn-default btn-law" value="5">[σ]</button>
                      </div>
              </div>
              <hr>
              <div class="law col-md-12" id="blk-1">
                  <p><b>loi uniforme</b></p>
                  <div class="form-group">
              <input type="text" class="form-control" placeholder="Min">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Max">
                   </div>
              </div>
              <div class="law col-md-12" id="blk-2">
                  <p><b>loi beta</b></p>
                  <div class="form-group">
              <input type="text" class="form-control" placeholder="Min">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Max">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="V">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="W">
                   </div>
              </div>
              <div class="law col-md-12" id="blk-3">
                  <p><b>loi triangulaire</b></p>
              <div class="form-group">
              <input type="text" class="form-control" placeholder="Min">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Max">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="C">
                   </div>
               </div>
              <div class="law col-md-12" id="blk-4">
                  <p><b>loi normale</b></p>
                  <div class="form-group">
              <input type="text" class="form-control" placeholder="Min">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Max">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Mu">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Sigma">
                   </div>
              </div>
              <div class="law col-md-12" id="blk-5">
                  <p><b>loi normale tronquée</b></p>
                  <div class="form-group">
              <input type="text" class="form-control" placeholder="Min">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Max">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Mu">
                   </div>
                   <div class="form-group">
              <input type="text" class="form-control" placeholder="Sigma">
                   </div>
              </div>
              <div class="col-md-12">
              <div class="row">
                  <button class="btn btn-default btn-block" id="createTaskButton" type="submit" name="submit" onclick="createTask();">Create task</button>
              </div>
          </div>
          </div>

          <div class="col-md-12">
              <button class="btn btn-default btn-block" type="button" name="submit" id="addLinkButton">
                  <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> Add Link</button>
          </div>
          <div class="row" id="linkConfig">
              <div class="col-md-6 ">
                  <fieldset class="form-group">
                      <label class="formLabel" for="leftTaskSelector">Source</label>
                      <select class="form-control" id="sourceSelector" data-toggle="tooltip" data-placement="right" title="Choose link's source">
                          <option>Start</option>
                      </select>
                  </fieldset>
              </div>
              <div class="col-md-6">
                  <fieldset class="form-group">
                      <label class="formLabel" for="rightTaskSelector">Target</label>
                      <select class="form-control" id="targetSelector" data-toggle="tooltip" data-placement="right" title="Choose link's target">
                          <option>End</option>
                      </select>
                  </fieldset>
              </div>
              <br>
              <div class="col-md-12">
                  <button class="btn btn-default" id="createLinkButton" type="submit" name="submit" onclick="createLink();">Create link</button>
              </div>
          </div>
  </div>
