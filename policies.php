<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" type="text/css">

  <link rel="icon" type="image/x-icon" size="16x16" href="./images/favicon.ico">
  <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
  <title>Policies - Kamloops Bike Rental</title>

  <style>

  main a {
    color: #FF8B8B;
  }
  main a:hover {
    color: #007bff;
    text-decoration: none;
  }
  main a:active {
    color: #0056b3;
  }

  h5:not(:first-of-type) {
    padding-top: 1rem;
  }

  table, p {
    color: lightgrey;
  }

  table tr td:first-child {
    width: 75%;
  }
  table tbody tr:not(:first-of-type) td {
    border-top: 0.5px solid lightgrey;
  }
  table tbody tr:last-of-type td {
    border-bottom: 0.5px solid lightgrey;
  }
  .table thead th {
    border-top: none;
  }
  .member-explain {
    color: #007bff;
    font-style: italic;
    font-size: 0.8em;
  }

  @media screen and (min-width: 576px) {
    .member-type {
      text-decoration: underline;
      text-decoration-style: dotted;
    }
    .member-explain {
      float: right;
      display: none;
    }
    table tr td:first-child:hover .member-explain {
      display: inline-block;
    }
  }

  @media screen and (max-width: 575px) {
    #policies-nav {
      display: none;
    }
  }

  </style>

</head>

<body>

  <header>
    <?php include 'header.php'; ?>
  </header>

  <main class='container-fluid'>
  <div class='row'>

  <div class='col-sm-3'>
    <ul id='policies-nav'></ul>
  </div>

  <div class='col-sm-8'>

    <h5 id='pol-rates'> <a href='#rates-area' data-toggle='collapse' data-target='#rates-area'>Rates</a></h5>
    <div id='rates-area' class='collapse show'>
    <table class='table'>
      <thead>
        <tr>
          <th>Membership Type</th>
          <th>Annual Rate</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            Individual
          </td>
          <td>$60</td>
        </tr>
        <tr>
          <td>
            <span class='member-type'>Individual, Low Income</span>
            <span class='member-explain'>Personal income less than $30,000</span>
          </td>
          <td>$25</td>
        </tr>
      </tbody>
    </table>
  </div>

  <h5 id='pol-late'><a href='#overdue-area' data-toggle='collapse' data-target='#overdue-area'>Overdue Items</a></h5>
  <div id='overdue-area' class='collapse'>
    <p> Members will be charged $20 per day for overdue items. You cannot rent a bike with oustanding fines on your account. </p>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a auctor orci. Aliquam vitae sem vehicula diam suscipit maximus ac at nisi. Aliquam aliquet nulla eget tincidunt ultrices. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis vitae tincidunt est. Quisque nec vulputate nunc, et pharetra felis. Fusce tristique nulla a risus vulputate gravida. Vestibulum erat odio, mollis eget tempor nec, finibus sit amet nunc. Vestibulum in nisl et est auctor ultrices. Nulla facilisi. Ut eget mauris risus. Vestibulum fringilla iaculis odio, eget consectetur lorem. </p>
  </div>

  <h5 id='pol-damage'><a href='#damage-area' data-toggle='collapse' data-target='#damage-area'>Damage & Loss</a></h5>
  <div id='damage-area' class='collapse'>
    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a auctor orci. Aliquam vitae sem vehicula diam suscipit maximus ac at nisi. Aliquam aliquet nulla eget tincidunt ultrices. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Duis vitae tincidunt est. Quisque nec vulputate nunc, et pharetra felis. Fusce tristique nulla a risus vulputate gravida. Vestibulum erat odio, mollis eget tempor nec, finibus sit amet nunc. Vestibulum in nisl et est auctor ultrices. Nulla facilisi. Ut eget mauris risus. Vestibulum fringilla iaculis odio, eget consectetur lorem. </p>
    <p>  Aliquam sagittis elit sed risus ornare varius. Ut porta diam eu eleifend varius. Aenean nec orci bibendum velit tincidunt commodo. Aliquam posuere, elit tempus consequat blandit, nulla lectus semper risus, nec porttitor nunc ex at eros. Etiam ultricies gravida sem quis tincidunt. Nullam eu enim lacus. Aenean sit amet erat eu felis gravida aliquet. Praesent euismod mi vel consectetur venenatis. Aenean pretium fringilla elit ut semper. Nulla facilisi. Nunc vel eros at lacus ultrices gravida. </p>
  </div>

  <h5 id='pol-privacy'><a href='#privacy-area' data-toggle='collapse' data-target='#privacy-area'>Privacy</a></h5>
  <div id='privacy-area' class='collapse'>
    <p> All of the personal information you provide is stored securely on the cs.tru.ca server and is used exclusively for the purpose of testing the website. Passwords are encrypted using the bcrypt algorithm. We don&rsquo;t collect any other data from your browser. </p>
  </div>

  </div>
  </div>
  </main>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>

$(document).ready(function() {
  $("header .nav-link[href='#policies']").addClass('disabled');

  $("h5 a").each(function() {
    let href = $(this).parent().attr('id');
    let target = $(this).attr('data-target');
    let new_li = "<li><a href='#" + href + "' data-toggle='collapse' data-target='" + target + "'>" + $(this).text() + "</a></li>";
    $("#policies-nav").append(new_li);
  });

});

</script>
