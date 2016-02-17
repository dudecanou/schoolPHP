<style>
.jumbotron {
  text-align:center;
  background: rgba(220, 220, 220, .9);
  box-shadow: -1px 2px 5px 1px rgba(0, 0, 0, 0.7),
              -1px 2px 20px rgba(255, 255, 255, 0.6) inset; }
</style>

<div class="col-md-3"></div>

<div class="col-md-6">
  <div class="jumbotron">
    <h2>Login Student</h2>
    <br>
<form class="form-horizontal" method="post" action="student_log0.php" style="padding-left:70px">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" name=login_etud class="form-control" placeholder="Enter login" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" name=password_etud class="form-control" placeholder="Enter password" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <button type="submit" name="student" class="btn btn-success" value="Insertion">Submit</button>

    </div>
  </div>
</form>


</div>
</div>


<div class="col-md-3">
