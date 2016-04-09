//扩展string，增加format方法，方便处理字符串
String.format = function(str) {
    var args = arguments, re = new RegExp("%([1-" + args.length + "])", "g");
    return String(str).replace(
        re,
        function($1, $2) {
            return args[$2];
        }
    );
};
Date.prototype.Format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份
        "d+": this.getDate(), //日
        "h+": this.getHours(), //小时
        "m+": this.getMinutes(), //分
        "s+": this.getSeconds(), //秒
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度
        "S": this.getMilliseconds() //毫秒
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

//声明数据源类别列表
var cal_data_category = [];
//类别列表生成所用的模板
var cal_data_category_template = '<li class="cal_data_category%1" ><div class="custom-checkbox"><input id="chk-category-%1" data-id="%1" type="checkbox" name="cal_data_category" value="%1" %2 autocomplete="off"> <label for="chk-category-%1" class="">%3</label></div></li>';
//弹出层模板
var popover_content_template = '<li><div class="category cal_data_category%1">%2</div><div class="wrap"><h4><a href="%3" target="_blank" >%4</a></h4><p class="date">%5</p><p class="content">%6</p></div></li>';

(function($) {

	"use strict";

    /*查询事件的函数*/
    var eventsSourceFn = function(calendar){
        var events=[];
        var displayYear=calendar.options.day.split("-")[0];
        var displayMonth=calendar.options.day.split("-")[1];
        var displayDay=calendar.options.day.split("-")[2];

        $.ajax({
            type: "GET",
            url: '',
            data: {
                PmtCldType:'all',
                PmtShType:calendar.options.view,
                PmtYear:displayYear,
                PmtMonth:displayMonth,
                PmtDay:displayDay
            },
            async:false,
            dataType: "json",
            success: function(resultList){
                if(resultList.success=="1"){
                    events= [].concat(resultList.result);
                }else{
                    events= [].concat([]);
                }
            },
            error:function(jqXHR,textStatus,errorThrown){
                events= [].concat([]);
            }
        });
        return events;
    };

    /*控件的options*/
    var options = {
		events_source: [],//数据源，可选为数组，json,外部文件（会自动通过ajax加载）
		view: 'month',//默认打开的视图
		tmpl_path: '/caltmpls/',//模板路径
		tmpl_cache: false,//模板是否缓存
		day: new Date().Format("yyyy-MM-dd"),//默认打开哪一天
		language: 'zh-CN',//默认语言
		first_day: 1,//一周第一天为星期几 ，1为星期一，2为星期天
        time_start:         '00:00',//时间视图下，开始时间
        time_end:           '24:00',//时间视图下，结束时间
        time_split:         '60',//时间视图下，默认分隔时间，分钟
        events_show_length: 3,//月视图下，默认显示几条记录，大于此值的记录会隐藏，并显示“还有X项”，请注意，如果此值大于默认值，可能会显示不下，需要调高event容器，修改css即可。
        holidays:{},//标记假日
		onAfterEventsLoad: function(events) {
		},
		onAfterViewLoad: function(view) {
			$('#cal_title').text(this.getTitle());
			$('.data-switch a').removeClass('active');
			$('a[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};

    //调用calendar
	var calendar = $('#calendar').calendar(options);

    //左右箭头点击事件
	$('.data-nav a[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

    //切换月周日 视图
	$('.data-switch a[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

    //类别勾选改变时，重新渲染视图
    $category_list.find('input[type=checkbox]').change(function(){
        var $this = $(this);
        var index = $this.attr('data-id') - 1;
        cal_data_category[index].checked = $this.prop('checked')?'checked':'';
        calendar._render();
    });

}(jQuery));
