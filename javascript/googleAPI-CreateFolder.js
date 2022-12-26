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

//document.getElementById('authorize_button').style.visibility = 'hidden';
//document.getElementById('signout_button').style.visibility = 'hidden';

/**
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

/**
 *  Sign in the user upon button click.
 */

function handleAuthClick(folderName, userEmail)
{
	tokenClient.callback = async (resp) => {
		if (resp.error !== undefined)
		{
			throw (resp);
		}

		//document.getElementById('signout_button').style.visibility = 'visible';
		//document.getElementById('authorize_button').value = 'Refresh';
		await createFolder(folderName);
		//await uploadFile();

	};
	
	//console.log(tokenClient.callback);

	if (gapi.client.getToken() === null)
	{
		// Prompt the user to select a Google Account and ask for consent to share their data
		// when establishing a new session.
		tokenClient.requestAccessToken({ hint: userEmail });
	}
	else
	{
		// Skip display of account chooser and consent dialog for an existing session.
		tokenClient.requestAccessToken({ hint: userEmail });
	}
}

/**
 *  Sign out the user upon button click.
 */
function handleSignoutClick()
{
	const token = gapi.client.getToken();
	if (token !== null) {
		google.accounts.oauth2.revoke(token.access_token);
		gapi.client.setToken('');
		/*
			document.getElementById('content').style.display = 'none';
			document.getElementById('content').innerHTML = '';
			document.getElementById('authorize_button').value = 'Authorize';
			document.getElementById('signout_button').style.visibility = 'hidden';
		*/
	}
}

/**
 * Upload file to Google Drive.
 */
async function uploadFile(parentId)
{
	var fileContent = 'Hello World'; // As a sample, upload a text file.
	var file = new Blob([fileContent], { type: 'text/plain' });
	var metadata = {
		'name': 'sample-file-test_check-js', // Filename at Google Drive
		'mimeType': 'text/plain',
		'parents': [parentId] // mimeType at Google Drive
		// TODO [Optional]: Set the below credentials
		// Note: remove this parameter, if no target is needed
		//'parents': ['SET-GOOGLE-DRIVE-FOLDER-ID'], // Folder ID at Google Drive which is optional
	};

	var accessToken = gapi.auth.getToken().access_token; // Here gapi is used for retrieving the access token.
	console.log(accessToken);
	var form = new FormData();
	form.append('metadata', new Blob([JSON.stringify(metadata)], { type: 'application/json' }));
	form.append('file', file);

	var xhr = new XMLHttpRequest();
	xhr.open('post', 'https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart&supportsAllDrives=true&fields=id');
	xhr.setRequestHeader('Authorization', 'Bearer ' + accessToken);
	xhr.responseType = 'json';
	xhr.onload = () => {
		//document.getElementById('content').innerHTML = "File uploaded successfully. The Google Drive file id is <b>" + xhr.response.id + "</b>";
		//document.getElementById('content').style.display = 'block';
		insertPermission(xhr.response.id,accessToken);
		console.log(xhr.response);
	};
	xhr.send(form);
}

function createFolder(folderName)
{
	/*
	if(localStorage.getItem("access_token") === null)
	{
		localStorage.setItem("access_token",access_token);
	}
	else
	{
		var access_token = localStorage.getItem("access_token");
	}
	*/
	var access_token = gapi.auth.getToken().access_token;
	
	var request = gapi.client.request({
		'path': '/drive/v2/files/',
		'method': 'POST',
		'headers': {
			'Content-Type': 'application/json',
			'Authorization': 'Bearer ' + access_token,             
		},
		'body':{
			"title" : folderName,
			"mimeType" : "application/vnd.google-apps.folder",
			'type': 'anyone',
			'role': 'reader'
		}
	});
 
	request.execute(function(resp) { 
		console.log('Folder'); 
		console.log(resp); 
		insertPermission(resp.id, access_token);
		//location.reload();
		//uploadFile(resp.id);
		//console.log(parent);
		//document.getElementById("info").innerHTML = "Created folder: " + resp.title;
	});
}




function insertPermission(fileId, oauthToken)
{
	localStorage.setItem("folderId",fileId);
	
	var request1 = gapi.client.request({
		'path': '/drive/v3/files/' + fileId + '/permissions',
		'method': 'POST',
		'headers': {
		  'Content-Type': 'application/json',
		  'Authorization': 'Bearer ' + oauthToken
		},
		'body':{
			'type': 'anyone',
			'role': 'reader'
		}
	  });
	  request1.execute(function(resp) {
		console.log(resp);
	  });
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