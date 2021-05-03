function error_handler(error){
	alert("error: " + error);
}

function getXmlHttpRequest(){
	try{
		var xhr = null;
		if(window.XMLHttpRequest){
			xhr = new XMLHttpRequest();
		}else{
			if(window.ActiveXObject){
				try{
					xhr = new ActiveXObject("Msxml2.XMLHTTP");
				}catch(error){
					xhr = new ActiveXObject("Microsoft.XMLHTTP");
				}
			}else{
				alert("Browser doesn't support XML HTTP Request Objects");
				xhr = null;
			}
		}

		return xhr;
	}catch(error){
		error_handler(error);
	}
}

function search_purchase(){
	try{
		var xhr = getXmlHttpRequest();
		xhr.onreadystatechange = function(){
			//console.log(xhr.responseText);
			if(xhr.readyState == 4 && xhr.status == 200){
				document.getElementById("purchase_table").innerHTML = xhr.responseText;
			}
		}
		xhr.open("POST","search.php");

		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send("date=" + document.getElementById("search_date").value);
	}catch(error){
		error_handler(error);
	}
}


function delete_purchase(order_code){
	try{
		var xhr = getXmlHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				search_purchase();
			}
		}
		xhr.open("POST","search.php");

		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.send("delete=" + order_code);
	}catch(error){
		error_handler(error);
	}
}