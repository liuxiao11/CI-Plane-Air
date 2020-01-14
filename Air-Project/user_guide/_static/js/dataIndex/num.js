//数字滚动
;(function($, window, document) {
    "use strict";
    var defaults = {
        deVal: 0,       //传入值
        className:'dataNums',   //样式名称
        digit:''    //默认显示几位数字
    };
    function rollNum(obj, options){
        this.obj = obj;
        this.options = $.extend(defaults, options);
        this.init = function(){
             this.initHtml(obj,defaults);
        }
    }
    rollNum.prototype = {
        initHtml: function(obj,options){
            var strHtml = '<ul class="' + options.className + ' inrow">';
            var valLen = options.digit ||  (options.deVal + '').length;
            if(obj.find('.'+options.className).length <= 0){
                for(var i = 0; i<  valLen; i++){''
                    strHtml += '<li class="dataOne "><div class="dataBoc"><div class="tt" t="38"><span class="num'+(options.deVal+'')[i]+'">'+(options.deVal+'')[i]+'<span> </div></div></li>';
                }
                strHtml += '</ul>';
                obj.html(strHtml);
            }
        },
    };
    $.fn.rollNum = function(options){
        var $that = this;
        var rollNumObj = new rollNum($that, options);
        rollNumObj.init();
    };
})(jQuery, window, document);