var is_webkit = /webkit/.test(navigator.userAgent.toLowerCase());
var $body = $(is_webkit ? 'body' : 'html');
var window_top = $body.scrollTop();
