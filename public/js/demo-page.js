function initDemoPage() {
  const demoImagePath = '/image/demo_sticker/';
  addSticker(demoImagePath + 'd.png', 20, 50);
  addSticker(demoImagePath + 'e.png', 210, 180);
  addSticker(demoImagePath + 'm.png', 400, 60);
  addSticker(demoImagePath + 'o.png', 630, 180);
}

window.onload = function(){
  initDemoPage();
};

function demoSave() {
  alert('Require Sign in.');
}
