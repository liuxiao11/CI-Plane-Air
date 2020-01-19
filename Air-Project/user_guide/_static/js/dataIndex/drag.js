var elem=document.getElementById('gridsterBox');
elem.onmousedown = function(event){//鼠标按下
    isDrag = true;
    startX = parseInt(this.style.left || getCSSValue(this,'left'));
    startY = parseInt(this.style.top || getCSSValue(this,'top'));
    mX = event.pageX;
    mY = event.pageY;
    temp = undefined;
    document.onmousemove = function(event){//鼠标移动
        this.innerHTML = 'Mouse Position('+event.pageX+','+event.pageY+')';
        if(isDrag){//当前正在移动
            if(temp == undefined){//temp临时拖动目标不存在
                temp = document.createElement('div');
                temp.id = 'drag';
                temp.className = 'temp';
                document.body.appendChild(temp);//将temp临时拖动目标添加到页面中
            }
            //改变位置
            temp.style.left = (startX + event.pageX - mX) + 'px';
            temp.style.top = (startY + event.pageY - mY) + 'px';
            console.log(temp)
            //检测是否在目标范围内
            if(checkIntersect(elem,$('#gridsterBox1'),20)){
                //在范围内
                $('#gridsterBox1').css('border','2px #F00 dashed');
                $('#gridsterBox1').css('-webkit-animation-name','light');
                $('#gridsterBox1').css('-webkit-animation-duration','1s');
                $('#gridsterBox1').css('-webkit-animation-delay','0.5s');
                $('#gridsterBox1').css('-webkit-animation-iteration-count','100');

            }else{
                //不在范围内
                $('#gridsterBox1').css('border','2px #09F dashed');
                $('#gridsterBox1').css('-webkit-animation-name','');
            }
        }
    };
    document.onmouseup = function(){//鼠标释放
        isDrag = false;
        if(checkIntersect(elem,$('#gridsterBox'),20)){
            elem.style.left=$('#gridsterBox').offsetLeft+'px';
            elem.style.top=$('#gridsterBox').offsetTop+'px';

        }else{
            elem.style.left=temp.offsetLeft+'px';
            elem.style.top=temp.offsetTop+'px';
        }
        document.body.removeChild(temp);//移出临时拖动目标
        temp = null;
        $('#gridsterBox1').css('border','2px #09F dashed');
        $('#gridsterBox1').css('-webkit-animation-name','');
    };
};

function getCSSValue(obj,key){//获取元素CSS值
    if(obj.currentStyle){//IE
        return obj.currentStyle[key];
    }else{//!IE
        return document.defaultView.getComputedStyle(obj,null)[key];
    }
}
function checkIntersect(obj1,obj2,distance){//检测碰撞,distance为吸附的范围
    var left1 = obj1.offsetLeft;
    var top1 = obj1.offsetTop;
    var left2 = obj2.offsetLeft;
    var top2 = obj2.offsetTop;
    var width1 = obj1.offsetWidth;
    var height1 = obj1.offsetHeight;
    var width2 = obj2.offsetWidth;
    var height2 = obj2.offsetHeight;
    return (
        ((left1-left2>=0&&left1-left2<width2+distance)||
            (left2-left1>=0&&left2-left1<width1+distance))&&
        ((top1-top2>=0&&top1-top2<height2+distance)||
            (top2-top1>=0&&top2-top1<height1+distance))
    );
}
