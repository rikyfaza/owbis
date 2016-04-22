<style type="text/css">
  body {
    padding-top: 40px;
    padding-bottom: 40px;
  }
  .form-signin {
    max-width: 300px;
    padding: 19px 29px 29px;
    margin: 0 auto 20px;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    -webkit-border-radius: 5px;
       -moz-border-radius: 5px;
            border-radius: 5px;
    -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
       -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
  }
  .form-signin .form-signin-heading,
  .form-signin .checkbox {
    margin-bottom: 10px;
  }
  .form-signin input[type="select"],
  .form-signin input[type="text"],
  .form-signin input[type="password"] {
    font-size: 14px;
    height: auto;
    margin-bottom: 15px;
    padding: 7px 9px;
  }
</style>

<div class="container">
  
    <?php
    if ($this->session->flashdata('error'))
    {
      echo "<div class='alert alert-error'>";
      echo "<div class='message'>";
      echo $this->session->flashdata('error');
      echo "</div>";
      echo "</div>";
    }
      ?>

    <?php
      echo form_open('setup/verify', array('class' => 'form-signin'));
    ?>
    <h3 class="form-signin-heading">Please sign in</h3>
    <label style='float:left'>Username</label>
    <input type="text" class="input-block-level" placeholder="username" name='username' >
    <label style='float:left'>Password</label>
    <input type="password" class="input-block-level" placeholder="password" name='password' >
    <label style='float:left'>Database</label>
    <select  name='dbname' placeholder='database name' class="input-block-level">
      <option value="0"><none></option>
      <?php foreach($listdb as $row){ ?>
        <option value='<?php echo $row['iddb']; ?>' ><?php echo $row['dbname']; ?></option>
      <?php } ?>
    </select>
    <br /><br />
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
  
    <?php  
      echo form_close();
    ?>
</div>



