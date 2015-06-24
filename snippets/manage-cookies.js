function check_cookies_enabled() {
  if(navigator.cookieEnabled) return true;
  document.cookie = 'cookietest=1';
  var cookies_enabled = document.cookie.indexOf('cookietest=') != -1;
  document.cookie = 'cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT';
  return cookies_enabled;
}
function create_cookie(name, value, days) {
  var expires = '';
  if(days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = '; expires=' + date.toGMTString();
  }
  document.cookie = name + '=' + value + expires + '; path=/';
}
function read_cookie(name) {
  var name_eq = name + '=';
  var all_cookies = document.cookie.split(';');
  for(var i = 0; i < all_cookies.length; i++) {
    var c = all_cookies[i];
    while(c.charAt(0) === ' ') {
      c = c.substring(1, c.length);
    }
    if(c.indexOf(name_eq) === 0) {
      return c.substring(name_eq.length, c.length);
    }
  }
  return null;
}
function erase_cookie(name) {
  create_cookie(name, '', -1);
}