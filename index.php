<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>Search</h3>
<input type="text" name="search" id="search" onkeyup="search()" autofocus>

<h3>Result</h3>
<div id="result"></div>
</body>
</html>

<script type="text/javascript">

function search(){

	var getId = document.getElementById('search').value;

	ajax({

		url:"search.php",
		type:"GET",

		data:{
		  id: getId
		},
		success: function(data){

            // var input = JSON.parse(data)

            // if (input['status'] == 'success' && input['code'] == 200){

            //     var first_name = input['data']['firstname'];
            // }

			document.getElementById("result").innerHTML = JSON.parse(data)[0];
		},
		error: function (data){
			alert('error');
		}

	});

}

	
function initXMLhttp() {

    var xmlhttp;
    if (window.XMLHttpRequest) {

        xmlhttp = new XMLHttpRequest();
    } else {

        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    return xmlhttp;
}

function ajax(config) {

    if (!config.url) {

        if (config.debugLog == true)
            console.log("No Url!");
        return;

    }

    if (!config.type) {

        if (config.debugLog == true)
            console.log("No Default type (GET/POST) given!");
        return;

    }

    if (!config.method) {
        config.method = true;
    }


    if (!config.debugLog) {
        config.debugLog = false;
    }

    var xmlhttp = initXMLhttp();

    xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

            if (config.success) {
                config.success(xmlhttp.responseText, xmlhttp.readyState);
            }

            if (config.debugLog == true)
                console.log("SuccessResponse");
            if (config.debugLog == true)
                console.log("Response Data:" + xmlhttp.responseText);

        } else {

            if (config.debugLog == true)
                console.log("FailureResponse --> State:" + xmlhttp.readyState + "Status:" + xmlhttp.status);
        }
    }

    var sendString = [],
        sendData = config.data;
    if( typeof sendData === "string" ){
        var tmpArr = String.prototype.split.call(sendData,'&');
        for(var i = 0, j = tmpArr.length; i < j; i++){
            var datum = tmpArr[i].split('=');
            sendString.push(encodeURIComponent(datum[0]) + "=" + encodeURIComponent(datum[1]));
        }
    }else if( typeof sendData === 'object' && !( sendData instanceof String || (FormData && sendData instanceof FormData) ) ){
        for (var k in sendData) {
            var datum = sendData[k];
            if( Object.prototype.toString.call(datum) == "[object Array]" ){
                for(var i = 0, j = datum.length; i < j; i++) {
                        sendString.push(encodeURIComponent(k) + "[]=" + encodeURIComponent(datum[i]));
                }
            }else{
                sendString.push(encodeURIComponent(k) + "=" + encodeURIComponent(datum));
            }
        }
    }
    sendString = sendString.join('&');

    if (config.type == "GET") {
        xmlhttp.open("GET", config.url + "?" + sendString, config.method);
        xmlhttp.send();

        if (config.debugLog == true)
            console.log("GET fired at:" + config.url + "?" + sendString);
    }
    if (config.type == "POST") {
        xmlhttp.open("POST", config.url, config.method);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(sendString);

        if (config.debugLog == true)
            console.log("POST fired at:" + config.url + " || Data:" + sendString);
    }
}
</script>