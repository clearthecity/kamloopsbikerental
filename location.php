<!DOCTYPE html>
<!-- LOCATION -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" type="text/css">

  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
  <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
  <title>Location - Kamloops Bike Library</title>

  <style>
  address {
    color: lightgrey;
  }
  </style>
</head>

<body>

  <header>
    <?php include 'header.php'; ?>
  </header>

  <main class="container-fluid">
  <div class='row'>

    <div class='col-lg-3 col-md-4 offset-md-1'>

      <address>
        805 TRU Way<br>
        Kamloops, BC V2C 0C8<br>
        (250) 222-2222</br>
        <span style='color:#007bff' class='crossout-on-hover'>wearefake@kamloopsbikerental.ca</span>
      </address>

      <p>Automated pickup and return open 24/7 (email address and password required).</p>
      <p>Human service: Tuesday-Saturday, 9-5. We are closed on statutory holidays.</p>
    </div>

    <div class='col-lg-5 col-md-6 offset-md-1'>
      <img src='./images/tru_map.png' alt='Campus map' style='max-width: 100%; background-color: white'>
      <button class='btn btn-secondary' data-toggle='modal' data-target='#modal-map' style='margin: 0.5em auto 0 auto'>Enlarge</button>
    </div>

  </main>

    </div>
    <div class='modal fade' id='modal-map' style='width: 100%'>
    <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
        <img src='./images/tru_map.png' alt='Campus map' style='max-width: 100%'>
        <button class='btn btn-secondary' data-dismiss='modal'>Close</button>
      </div>
    </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
$(document).ready(function() {
  $("header .nav-link[href='#location']").addClass('disabled');
});
</script>
