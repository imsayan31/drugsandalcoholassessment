jQuery(document).ready(function($){

    // $('[data-toggle="tooltip"]').tooltip(); 

	$('.user_location').chosen({
		width: '100%'
	});

});

/* Site Redirection */
function siteRedirection(url, time) {
    setTimeout(function () {
        window.location.href = url;
    }, time);
}

/* Check String Contains Alphabets */
function checkForAlphabets(str) {
    var patt = /^[a-zA-Z ]+$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Numbers */
function checkForNumbers(str) {
    var patt = /^\d+$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Emails */
function checkForEmails(str) {
    var patt = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}

/* Check String Contains Passwords */
function checkForPassword(str) {
    var patt = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
    if (patt.test(str) == true) {
        return true;
    } else {
        return false;
    }
}