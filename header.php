<!DOCTYPE html>
<noscript>This site requires JavaScript.</noscript>

<nav id="top-nav" class="navbar navbar-expand-sm navbar-fixed-top">
  <a class="navbar-brand" href="#main" onclick='goHome()'><img src="./images/gearlogo.jpg" width="30" height="30" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#top-nav-menu" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><img src='./images/hamburger_toggle.svg' alt='' /></span>
  </button>
  <div class="collapse navbar-collapse" id="top-nav-menu">
    <ul class="nav navbar-nav mr-auto">
      <li class="nav-item"><a class='nav-link' href="#main" onclick='goHome()'>Bikes</a></li>
      <li class="nav-item"><a class='nav-link' href="#location" onclick='goToLocation()'>Location</a></li>
      <li class="nav-item"><a class='nav-link' href="#policies" onclick='goToPolicies()'>Policies</a></li>
    </ul>
    <ul class='nav navbar-nav mr-sm-2 navbar-right'>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="name-account-dropdown" data-toggle="dropdown">
          <span id='username-dropdown'>
            <?php if (isset($_SESSION['fname'])) echo $_SESSION['fname']; else echo "FirstName"; ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#account" onclick='goToAccount()'>Account</a>
          <a class="dropdown-item" href='#logout' onclick='sendLogoutForm()'>Logout</a>
        </div>
      </li>
    </ul>
</div>
</nav>

  <form id='hidden-header-form' method='post' action='bikerental.php' style='display:none'>
    <input type='hidden' name='page' value='any' />
    <input type='hidden' id='header-command' name='command' />
  </form>

<script>
window.addEventListener('mousemove', restartTimer);
window.addEventListener('keydown', restartTimer);

const FIVE_MIN = 5 * 60 * 1000;
let timer = setTimeout(sendLogoutForm, FIVE_MIN);

function restartTimer() {
  clearTimeout(timer);
  timer = setTimeout(sendLogoutForm, FIVE_MIN);
}

function sendLogoutForm() {
  clearTimeout(timer);
  document.getElementById('header-command').value = 'LogOut';
  document.getElementById('hidden-header-form').submit();
}

function goToAccount() {
  clearTimeout(timer);
  document.getElementById('header-command').value = 'GoToAccount';
  document.getElementById('hidden-header-form').submit();
}

function goToLocation() {
  clearTimeout(timer);
  document.getElementById('header-command').value = 'GoToLocation';
  document.getElementById('hidden-header-form').submit();
}

function goToPolicies() {
  clearTimeout(timer);
  document.getElementById('header-command').value = 'GoToPolicies';
  document.getElementById('hidden-header-form').submit();
}

function goHome() {
  clearTimeout(timer);
  document.getElementById('header-command').value = 'GoHome';
  document.getElementById('hidden-header-form').submit();
}

</script>

</html>
