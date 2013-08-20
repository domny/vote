var DOM = KISSY.DOM , Event = KISSY.Event ;

var  t = DOM.query(".viewreport")[0];
var  tt = DOM.query(".topbtn")[0];
var appd = DOM.query('.appDomin')[0];
 var domain = appd.value;

Event.on(t,"click", function (e) {

        KISSY.io({
            dataType:'jsonp',
            url:domain + "/view/front/report_jsonp.php",
            data:{
                'format': 'json'
            },
            jsonp:"callback",
            success:function (data) {
                var html = '<ul>';
                for(var i=0;i<data.items.length;i++){
                         html += '<li>' + data.items[i].name +':'+data.items[i].count+ '</li>';
                }
                html += '</ul>';
                var report =DOM.query('.report')[0];
                report.innerHTML = html;
            }
        });

    });


Event.on(tt,"click", function (e) {

 	var topinput = DOM.query('.topinput')[0].value  ;

        KISSY.io({
            dataType:'jsonp',
            url:domain + "/view/front/report_jsonp.php",
            data:{
                'nick' : topinput,
                'type' : 'top',
                'format': 'json'
            },
            jsonp:"callback",
            success:function (data) {
                var html = '<ul>';
                html += '<li>' + data.items[0].name + '</li>';
                html += '<li>' + data.items[0].nick + '</li>';
                html += '</ul>';
                var report =DOM.query('.topoutput')[0];
                report.innerHTML = html;
            }
        });

    });
