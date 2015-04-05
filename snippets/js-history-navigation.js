function processAjaxData(response, urlPath) {
  document.getElementById('content').innerHTML = response.html;
  document.title = response.pageTitle;
  window.history.pushState(
    {
      'html': response.html,
      'pageTitle': response.pageTitle
    }, '', urlPath
  );
}

window.onpopstate = function(e){
  if(e.state) {
    document.getElementById('content').innerHTML = e.state.html;
    document.title = e.state.pageTitle;
  }
};