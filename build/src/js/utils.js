//
//
//
//
// GERENCIA A REQUISIÇÃO HTTP
//
// REFERÊNCIA:
// https://www.google.com/search?q=AJAX+VANILLA+JS
// https://wickedev.com/use-vanilla-javascript-to-make-ajax-request/
//
//
//
//

/* const api = axios.create({
    baseURL: ''
}) */

// api.get()

/**
 * Creates a new URL by combining the specified URLs
 *
 * @param {string} baseURL The base URL
 * @param {string} relativeURL The relative URL
 *
 * @returns {string} The combined URL
 */
function combineURLs(baseURL, relativeURL) {
    return relativeURL ? baseURL.replace(/\/+$/, '') + '/' + relativeURL.replace(/^\/+/, '') : baseURL;
}

function $Ajax() {}

$Ajax.prototype.create = function({ baseURL = '', headers = {} }) {
    const newInstance = new $Ajax().prototype = {
        baseURL,
        post: $Ajax.prototype.post,
        get: $Ajax.prototype.get
    }

    return newInstance;
}

$Ajax.prototype.post = function(
    relativeURL, 
    data, 
    options = {}
) {
    console.log('New Instance baseURL POST:', this.baseURL)
    console.log('::: $ajax POST > url and data:', relativeURL, data);

    if (options.hasOwnProperty('params')) {
        let queryString = Object.keys(options.params)
            .map(key => key + '=' + options.params[key])
            .join('&');
        
        relativeURL = relativeURL + '?' + queryString;
    }

    // Create the XMLHttpRequest object.
    var xhr = new XMLHttpRequest();
    // Initialize the request
    if (this.baseURL) {
        xhr.open("POST", combineURLs(this.baseURL, relativeURL), true);
    } else {
        xhr.open("POST", relativeURL, true);
    }

    if (options.hasOwnProperty('headers')) {
        Object.keys(options.headers).forEach(function (headerKey) {
            xhr.setRequestHeader(headerKey, options.headers[headerKey]);
        });
    }

    // Check if the data is an instance of FormData
    if (data instanceof FormData) {
        // Send the request with data to post
        xhr.send(data);
    } else {
        // Set content type
        xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

        // Send the request with data to post
        xhr.send(JSON.stringify(data));
    }

    // Fired once the request completes successfully 
    return new Promise((resolve) => {
        xhr.onload = function(e) {
            // Check if the request was a success
            if (this.readyState === XMLHttpRequest.DONE) {
                var response = JSON.parse(xhr.responseText);

                var responseSerialized = {
                    data: response,
                    ok: null
                };

                if (this.status === 200 || this.status === 201) {
                    responseSerialized.ok = true;
                    resolve(responseSerialized);
                    console.log('::: $ajax POST > Sucesso:', responseSerialized);
                } else if (this.status >= 400) {
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax POST > Error:', responseSerialized);
                } else if (this.status >= 500) {
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax POST > Error:', responseSerialized);
                } else {
                    // Unknown
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax POST > Error:', responseSerialized);
                }
            }
        }
    });
}

$Ajax.prototype.get = function (relativeURL, options = {}) {
    console.log('New Instance baseURL GET:', this.baseURL)
    console.log('::: $ajax GET > url:', relativeURL);

    if (options.hasOwnProperty('params')) {
        let queryString = Object.keys(options.params)
            .map(key => key + '=' + options.params[key])
            .join('&');
        
        relativeURL = relativeURL + '?' + queryString;
    }

    // Create the XMLHttpRequest object.
    var xhr = new XMLHttpRequest();
    
    // Initialize the request
    if (this.baseURL) {
        xhr.open("GET", combineURLs(this.baseURL, relativeURL), true);
    } else {
        xhr.open("GET", relativeURL, true);
    }
    
    // Set content type
    xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    
    if (options.hasOwnProperty('headers')) {
        Object.keys(options.headers).forEach(function (headerKey) {
            xhr.setRequestHeader(headerKey, options.headers[headerKey]);
        });
    }

    // Send the request get
    xhr.send();
    // Fired once the request completes successfully 
    return new Promise((resolve) => {
        xhr.onload = function(e) {
            // Check if the request was a success
            if (this.readyState === XMLHttpRequest.DONE) {
                var response = JSON.parse(xhr.responseText);

                var responseSerialized = {
                    data: response,
                    ok: null
                };

                if (this.status === 200 || this.status === 201) {
                    responseSerialized.ok = true;
                    resolve(responseSerialized);
                    console.log('::: $ajax GET > Sucesso:', responseSerialized);
                } else if (this.status >= 400) {
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax GET > Error:', responseSerialized);
                } else if (this.status >= 500) {
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax GET > Error:', responseSerialized);
                } else {
                    // Unknown
                    responseSerialized.ok = false;
                    resolve(responseSerialized);
                    console.log('::: $ajax GET > Error:', responseSerialized);
                }
            }
        }
    });
}

export var $ajax = new $Ajax();

export var $object = {
    /**
     * Alternative for Object.assign 
     * @param {array} objs 
     * @returns merge of the objects
     */
    assign: function(objs){ 
        var merge =  objs.reduce(function (r, o) {
            Object.keys(o).forEach(function (k) {
                r[k] = o[k];
            });
            return r;
        }, {});

        return merge;
    }
}

export function $el(seletor) {
    return document.querySelector(seletor);
}

export function $els(seletor) {
    return document.querySelectorAll(seletor);
}

export function $trim(textElement) {
    return textElement.trim(); 
} 

// Working on IE8+
export function $addClass(el, className) {
    if (el) {
        if (el.classList) {
            el.classList.add(className);
        } else {
            var current = el.className, found = false;
            var all = current.split(' ');
            for(var i=0; i<all.length, !found; i++) found = all[i] === className;
            if(!found) {
                if(current === '') el.className = className;
                else el.className += ' ' + className;
            }
        }
    }
}

// Working on IE8+
export function $removeClass(element, className) {
    if (element) {
        if (element.classList)
            element.classList.remove(className);
        else
            element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    }
}


export function $event(event, element, fn) {
    if (window.addEventListener) {
        if (typeof element === 'string') {
            const selector = document.querySelector(element);
            selector.addEventListener(event, fn, false);            
        } else {
            element.addEventListener(event, fn, false);            
        }
    }
    else if (window.attachEvent) {
        if (typeof element === 'string') {
            const selector = document.querySelector(element);
            selector.attachEvent(`on${event}`, fn);            
        } else {
            element.attachEvent(`on${event}`, fn);            
        }
    }
    else {
        if (typeof element === 'string') {
            const selector = document.querySelector(element);
            selector[`on${event}`] = fn;            
        } else {
            element[`on${event}`] = fn;          
        }
    }
}

export function $hasClass(element, className) {
    return new RegExp('(\\s|^)' + className + '(\\s|$)').test(element.className);
}

export function $attr(element, attribute, value = "") {
    element.setAttribute(attribute, value);
}

export function $getAttr(element, attribute) {
    return element.getAttribute(attribute);
}

export function $removeAttr(element, attribute) {
    element.removeAttribute(attribute);
}

export function $toggleAttr(element, attribute) {
    var attr = $getAttr(element, attribute);

    if (attr !== null) {
        $removeAttr(element, attribute);
        return false;
    } else {
        $attr(element, attribute);
        return true;
    }
}

/**
 * Exist this attribute on element 
 * @param {HTMLElement} element - element html
 * @param {string} attribute - attribute or property of element 
 * @returns {boolean} - returned a boolean 
 */
export function $findAttr(element, attribute) {
    var attr = $getAttr(element, attribute);

    if (attr !== null) {
        return true;
    } else {
        return false;
    }
}

export function $toggle(element, className, callback = function() {}) {
    if (!$hasClass(element, className)) {
        $addClass(element, className);
        callback(true);
    } else {
        $removeClass(element, className);
        callback(false);
    }
}

export function $find(element, seletor) {
    return element.querySelector(seletor);
}

export function $finds(element, seletor) {
    return element.querySelectorAll(seletor);
}

export function $addHTML(element, html) {
    element.innerHTML = html;
}

export function $addText(element, text) {
    element.innerText = text;
}

/**
 * Method Delay
 * @param {function} callback - action that will perform only once
 * @param {number} time - delay in seconds
 */
export function $delay(callback, time) {
    setTimeout(callback, time * 1000);
}

//https://stackoverflow.com/questions/524696/how-to-create-a-style-tag-with-javascript
/**
 * 
 * @param {css} styleSheet 
 */
export function $style(css) {
    var head = document.head || document.getElementsByTagName('head')[0];
    var style = document.createElement('style');

    style.type = 'text/css';
    if (style.styleSheet){
        // This is required for IE8 and below.
        style.styleSheet.cssText = css;
    } else {
        style.appendChild(document.createTextNode(css));
    }

    head.appendChild(style);
}

/**
 * 
 * @param {int} s - how long do you sleep in seconds
 * @returns return promise sleeping  
 */
export var $sleep = (s) => new Promise((p) => setTimeout(p, (s * 1000) | 0));

/**
 * Verify variable was defined, it exist on scope
 * @param {any} variableName 
 * @returns return boolean
 */
export var $isset = function(variableName) {
    if (typeof variableName !== 'undefined') {
        return true;
    } else {
        return false;
    }
}

/**
 * Verify variable string, array or object is empty
 * @param {string | array | object} variableName 
 * @returns return boolean
 */
export var $isEmpty = function(variableName) {
    if (!variableName || Object.keys(variableName).length === 0 || variableName.length === 0) {
        return false;
    } else {
        return true;
    }
}

export function $debounce(func, wait) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            func.apply(context, args);
        }, wait);
    };
};