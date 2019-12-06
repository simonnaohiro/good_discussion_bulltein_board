(function(){
  let show = document.getElementById('js-show');
  let hide = document.getElementById('js-hide');
  let showTarget = document.getElementById('js-show-target');
  show.addEventListener('focus', function(){
    showTarget.classList.remove('hide');
  });
  hide.addEventListener('click', function(){
    showTarget.classList.add('hide');
  });

})();
