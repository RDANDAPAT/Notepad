<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo base_url('index.php/home'); ?>">Notepad</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-link"><span class="text-info" id="digital-watch"></span></li> -->
          <li class="nav-link"><p class="text-info">Current Time: <span id="digital-watch"></span></p></li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('index.php/home'); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('index.php/Delete_Note'); ?>">Recycle Bin</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sorted by
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Date & Time</a>
          <a class="dropdown-item" href="#">BY Titel </a>
          <!-- <a class="dropdown-item" href="#">Something else here</a> -->
        </div>
      </li>
      <li class="nav-item" style="float: inline-end;">
        <a class="nav-link active" href="<?php echo base_url('index.php/Logout'); ?>">Logout</a>
      </li>
    </ul>
  </div>
</nav>
<hr class="bg-light" style="height: 4px;border: none; margin-top: 10px;">