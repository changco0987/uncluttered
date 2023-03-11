// TODO: Set the below credentials
const CLIENT_ID = 'REPLACE THIS WITH YOUR CLIENT ID FROM GOOGLE CONSOLE'; // Client ID
const API_KEY = 'REPLACE THIS WITH YOUR API KEY FROM GOOGLE CONSOLE'; //API key

// Discovery URL for APIs used by the quickstart
const DISCOVERY_DOC = 'https://www.googleapis.com/discovery/v1/apis/drive/v3/rest';

// Set API access scope before proceeding authorization request
const SCOPES = 'https://www.googleapis.com/auth/drive.file';
let tokenClient;
let gapiInited = false;
let gisInited = false;


/*
 * Callback after api.js is loaded.
 */
function gapiLoaded()
{
	gapi.load('client', initializeGapiClient);
}

/**
 * Callback after the API client is loaded. Loads the
 * discovery doc to initialize the API.
 */
async function initializeGapiClient()
{
	await gapi.client.init({
		apiKey: API_KEY,
		discoveryDocs: [DISCOVERY_DOC],
	});
	gapiInited = true;
	maybeEnableButtons();
}

/**
 * Callback after Google Identity Services are loaded.
 */
function gisLoaded()
{
	tokenClient = google.accounts.oauth2.initTokenClient({
		client_id: CLIENT_ID,
		scope: SCOPES,
		prompt: '',
		callback: (tokenResponse) => {
			access_token = tokenResponse.access_token;
		}, // defined later
	});
	gisInited = true;
	maybeEnableButtons();
}

/**
 * Enables user interaction after all libraries are loaded.
 */
function maybeEnableButtons()
{
	if (gapiInited && gisInited)
	{
		//document.getElementById('authorize_button').style.visibility = 'visible';
	}
}

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