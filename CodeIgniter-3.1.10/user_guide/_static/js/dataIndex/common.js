//获取屏幕缩放比例
function getScale() {
    var width = 1920, height = 1080;
    let ww = window.innerWidth / width;
    let wh = window.innerHeight / height;
    return ww < wh ? ww : wh;
}

var scale = "scale(" + getScale() + ") translate(-50%, -50%)";
console.log(scale);
$('#container').css({"transform": scale});

