function request(requestURL, requestform){
  var scriptId = "get_page_content_html";
  oScript = document.getElementById(scriptId);
  var head = document.getElementsByTagName("head").item(0);
  if (oScript) {
     head.removeChild(oScript);
  }

  var gridurl = requestform.parentNode.getAttribute('gridurl');
  var originAction = requestform.getAttribute('action');
  var index = gridurl.indexOf("?_MODULE");
  if(index!=-1){
     requestURL = gridurl.substr(0,index) + originAction + gridurl.substr(index) + requestURL + "&wrap=a";
  }else{
     requestURL = gridurl + originAction + "?wrap" + requestURL;
  }
  alert("requestURL="+requestURL);
  oScript = document.createElement("script");
  oScript.setAttribute("src", requestURL);
  oScript.setAttribute("id",scriptId);
  oScript.setAttribute("type","text/javascript");
  oScript.setAttribute("language","javascript");
  var handler = function(str)
  {
     updatePage(requestform.parentNode,str);
  };
  oScript.onload = function()
  {
          //alert('oScript.onload');
          handler(page_content_html);
  };
  //alert("1");
  if(window.ie)
  {
     alert("11");
     oScript.onreadystatechange = function()
     {
        alert('onreadystatechange');
        if(oScript.readyState=='complete'||oScript.readyState== 'loaded')
        {
           var htmlContent=eval(page_content_html);
           if(typeof htmlContent != 'undefined')
           {
               handler(htmlContent);
           }
        }
     }
  }

  //alert("2");
  oScript= head.appendChild(oScript);
  //alert("3:"+oScript);
  //alert("4:page_content_html:"+page_content_html);
  //return oScript;
}

function onModuleSubmit(obj){
	if(!obj || !obj.form){
		alert("you should pass onModuleSubmit this in a form input element");
	}

  //alert("onModuleSubmit:"+obj.form);
  var url = '';
  if(obj.form.elements.length>0){
     for(var i = 0; i< obj.form.elements.length; i++){
        var ele = obj.form.elements[i];
        //alert("ele.type="+ele.type); //'button checkbox file hidden image password radio reset submit text'
        if(ele.type == 'radio' || ele.type == 'checkbox'){
           if(ele.checked){
                url =  url + "&" + ele.name + "=" + ele.value ;
           }
        }else if(ele.type == 'text' || ele.type == 'hidden'){
           url = url + "&" +  ele.name + "=" + ele.value;
        }
     }
     //alert(url);
  }
  request(url,obj.form); //url begin with &
}

function updatePage(div,htmlContent) {
   //alert("updatePage.div:"+div);
   //alert("updatePage.htmlContent:"+htmlContent);
   if(div){
      div.innerHTML=htmlContent;
   }
}

Function.prototype.getMultiline = function()
{
    var lines = new String(this);
    lines = lines.substring(lines.indexOf("/*") + 3, lines.lastIndexOf("*/"));
    return lines;
}