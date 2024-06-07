const courier = localStorage.getItem('courier');

function courierAuth() {
  if (!courier) {
    window.location.href = './courierLogin.php';
  }
}

window.onload = courierAuth;

function logout(){
    localStorage.removeItem('courier');
    localStorage.removeItem('submitted');
    window.location.href = './courierLogin.php';
}