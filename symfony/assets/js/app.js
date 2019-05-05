import 'bootstrap';

// Common CSS
import '../css/app.scss';

// import the function from welcome.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
import { welcome } from './functions/common.js'

$(document).ready(function() {
    $('body').append('<p>'+welcome('Adrien')+'</p>');
});
