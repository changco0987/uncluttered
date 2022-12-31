// TODO: Set the below credentials
const CLIENT_ID = '509002600811-8ht8f7pc6hufkis14h82o1klij3k0797.apps.googleusercontent.com';
const API_KEY = 'AIzaSyA1sWrq5rW03TVeWoPorXXxIQzr9VAkeOc';

// Discovery URL for APIs used by the quickstart
const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

// Set API access scope before proceeding authorization request
const SCOPES = 'https://www.googleapis.com/auth/drive.file';
let tokenClient;
let gapiInited = false;
let gisInited = false;


function handleCredentialResponse(response)
{
	//handleAuthClick();
	const responsePayload = decodeJwtResponse(response.credential);
	localStorage.setItem("response",responsePayload.sub);

	//console.log('token: '+Object.values(gapi.client.getToken()));
	console.log(responsePayload.sub);
	console.log('ID: '+responsePayload.sub);
	console.log('Full Name: '+responsePayload.name);
	console.log('Given Name: '+responsePayload.given_name);
	console.log('Family Name: '+responsePayload.family_name);
	console.log('Image URL: '+responsePayload.picture);
	console.log('Email: '+responsePayload.email);
/*
	var http = new XMLHttpRequest();
		http.open("POST", "controller/loginWithGmail.php", true);
		http.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		//This is the form input fields data
		var params = "submitLogin="+true+
					"&usernameTb="+responsePayload.email+
					"&passwordTb="+responsePayload.sub+
					"&fnameTb="+responsePayload.given_name+
					"&lnameTb="+responsePayload.family_name+
					"&emailTb="+responsePayload.email+
					"&imageName="+responsePayload.picture+
					"&gmail_IdTb="+responsePayload.sub; // probably use document.getElementById(...).value

		http.send(params);
		http.onload = function() 
		{
			var loginRes = http.responseText;
			console.log(loginRes);
			if(loginRes == '3')
			{
				//successfully login
				window.location = 'pages/userdashboard.php';
			}
			else if(loginRes =='1')
			{
				url.searchParams.set('loginRes', loginRes);
				window.history.replaceState(null, null, url); // or pushState
				location.reload();
			}
			else if(loginRes =='2')
			{
				url.searchParams.set('loginRes', loginRes);
				window.history.replaceState(null, null, url); // or pushState
				location.reload();
			}
			//returnDate();
			//console.log(params);
		}
		*/
}

function decodeJwtResponse(data)
{
	var tokens = data.split(".");
	return JSON.parse(atob(tokens[1]));
}

/*
function insertPermission(fileId)
{
	var body = {
	  'type': 'anyone',
	  'role': 'reader'
	};
	var request = gapi.client.drive.permissions.insert({
	  'fileId': fileId,
	  'resource': body
	});
	//request.execute(function(resp) { });
}
*/